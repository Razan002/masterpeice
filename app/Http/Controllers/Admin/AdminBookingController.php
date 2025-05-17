<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    /**
     * عرض صفحة الحجوزات مع إمكانية التصفية
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'package', 'destination'])
            ->latest();

        // تصفية حسب حالة الحجز
        if ($request->has('status') && in_array($request->status, ['pending', 'confirmed', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        // تصفية حسب طريقة الدفع
        if ($request->has('payment_method') && in_array($request->payment_method, ['online', 'on_spot'])) {
            $query->where('payment_method', $request->payment_method);
        }

        // تصفية حسب التاريخ
        if ($request->has('date_from')) {
            $query->where('booking_date', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->where('booking_date', '<=', $request->date_to);
        }

        $bookings = $query->paginate(15);

        return view('admin.booking.index', compact('bookings'));
    }

    /**
     * عرض نموذج إنشاء حجز جديد
     */
    public function create()
    {
        $users = User::select('id', 'name')->get();
        $packages = Package::select('id', 'title')->get();
        $destinations = Destination::select('id', 'name')->get();

        return view('admin.bookings.create', compact('users', 'packages', 'destinations'));
    }

    /**
     * حفظ الحجز الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'nullable|exists:packages,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'payment_method' => 'required|in:online,on_spot',
            'total_price' => 'required|numeric|min:0',
            'custom_package_details' => 'nullable|string|max:500',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        DB::transaction(function () use ($validated) {
            Booking::create($validated);
        });

        return redirect()->route('admin.bookings')
            ->with('success', 'تم إنشاء الحجز بنجاح');
    }

    /**
     * عرض تفاصيل حجز معين
     */
    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    /**
     * عرض نموذج تعديل الحجز
     */
    public function edit(Booking $booking)
    {
        $users = User::select('id', 'name')->get();
        $packages = Package::select('id', 'title')->get();
        $destinations = Destination::select('id', 'name')->get();

        return view('admin.booking.edit', compact('booking', 'users', 'packages', 'destinations'));    }

    /**
     * تحديث بيانات الحجز في قاعدة البيانات
     */
    public function update(Request $request, Booking $booking)

    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'nullable|exists:packages,id',
            'destination_id' => 'nullable|exists:destinations,id',
            'booking_date' => 'required|date',
            'payment_method' => 'required|in:online,on_spot',
            'total_price' => 'required|numeric|min:0',
            'custom_package_details' => 'nullable|string|max:500',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        DB::transaction(function () use ($booking, $validated) {
            $booking->update($validated);
        });

        return redirect()->route('admin.bookings')
            ->with('success', 'تم تحديث الحجز بنجاح');
    }

    /**
     * حذف الحجز من قاعدة البيانات
     */
    public function destroy(Booking $booking)
    {
        DB::transaction(function () use ($booking) {
            $booking->delete();
        });

        return redirect()->route('admin.bookings')
            ->with('success', 'تم حذف الحجز بنجاح');
    }

    /**
     * تغيير حالة الحجز
     */
    public function changeStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'تم تغيير حالة الحجز بنجاح',
            'new_status' => $request->status
        ]);
    }

    /**
     * إحصائيات الحجوزات
     */
    public function statistics()
    {
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
        ];

        return view('admin.bookings.statistics', compact('stats'));
    }
}