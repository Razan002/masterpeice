<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Review;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;
use App\Models\Product;

use function Psy\debug;

class GeneralAdminController extends Controller
{

        // Dashboard Methods
       public function dashboard()
{
    $usersCount = User::count();
    $bookingsCount = Booking::count();
    $packagesCount = Package::count();
    $reviewsCount = Review::count();
    
    $recentBookings = Booking::with(['user', 'package'])
                        ->latest()
                        ->take(5)
                        ->get();
    
    $bookingStats = $this->getBookingStats();
    
    // إحصائيات توزيع الحجوزات حسب الباقة
    $packageDistribution = Package::withCount('bookings')
                            ->having('bookings_count', '>', 0)
                            ->orderBy('bookings_count', 'desc')
                            ->get();
    
    $recentReviews = Review::with(['user', 'package', 'booking'])
                        ->latest()
                        ->take(5)
                        ->get();

                        if($packageDistribution->isEmpty()) {
        $packageDistribution = Package::take(5)->get()->map(function($item) {
            return (object)[
                'name' => $item->name,
                'bookings_count' => rand(1, 20)
            ];
        });
    }


   return view('admin.dashboard', [
    'bookingStats' => $bookingStats,
    'usersCount' => $usersCount,
    'bookingsCount' => $bookingsCount,
    'packagesCount' => $packagesCount,
    'reviewsCount' => $reviewsCount,
    'recentBookings' => $recentBookings,
    'packageDistribution' => $packageDistribution
]);

}
    
        protected function getBookingStats()
        {
            $months = [];
            $counts = [];
            
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $months[] = $month->format('F');
                $counts[] = Booking::whereYear('created_at', $month->year)
                                ->whereMonth('created_at', $month->month)
                                ->count();
            }
    
            return [
                'months' => $months,
                'counts' => $counts
            ];
        }
    


    public function manageUsers(Request $request)
    {
        $query = User::query();
    
        if ($request->has('role')) {
            $query->where('role', $request->role);
        }
    
        $users = $query->get();    
    
        $roles = [
            'general_admin' => 'General Admin',
            'general_owner' => 'General Owner',
            'user' => 'Regular User'
        ];
    
        return view('admin.users.index', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
    

    public function createUser()
    {
        $roles = [
            'general_admin' => 'General Admin',
            'general_owner' => 'General Owner',
            'user' => 'Regular User'
        ];
        
        return view('admin.users.create', compact('roles'));
    }

    public function storeUser(Request $request)
    {

        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:general_admin,general_owner,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return redirect()->route('admin.users.index')
                       ->with('success', '   user created successfully');
    }

    // public function showUser($id)
    // {
    //     $user = User::with(['bookings', 'reviews'])->findOrFail($id);
    //     return view('admin.users.index', compact('user'));
    // }
    

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = [
            'general_admin' => 'General Admin',
            'general_owner' => 'General Owner',
            'user' => 'Regular User'
        ];
        
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:general_admin,general_owner,user',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index', $user->id)
                       ->with('success', 'user updated successfully'); 
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        // التحقق من أن المستخدم ليس آخر أدمن
        if ($user->role === 'general_admin' && 
            User::where('role', 'general_admin')->count() <= 1) {
            return back()->with('error', 'لا يمكن حذف آخر أدمن في النظام');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
                       ->with('success', ' user deleted successfully');
    }
    public function manageReviews(Request $request)
    {
        // جلب التقييمات مع العلاقات الأساسية فقط
        $query = Review::with(['user', 'package']);
        
        // تطبيق الفلترة إذا وجد بحث
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('user', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                })
                ->orWhereHas('package', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%');
                })
                ->orWhere('comment', 'like', '%'.$request->search.'%');
            });
        }
        
        // جلب التقييمات مع استبعاد التي لا تحتوي على مستخدم أو باقة
        $reviews = $query->whereHas('user')
                       ->whereHas('package')
                       ->latest()
                       ->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }
    
}