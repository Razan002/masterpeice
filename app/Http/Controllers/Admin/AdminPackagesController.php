<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Media;
class AdminPackagesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'general_admin']);
    // }

    // عرض جميع الباقات
   public function index()
{
    $packages = Package::with('media')->latest()->paginate(8);
    return view('admin.packages.index', compact('packages'));
}


    // عرض نموذج إنشاء باقة جديدة
    public function create()
    {

        
        $guides = User::where('role', 'guide')->get();
        return view('admin.packages.create', compact('guides'));
    }

    // حفظ الباقة الجديدة
    public function store(Request $request)
{   
    // dd($request->all());
    // Validation
    
    $package = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|string',
        'max_people' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'date' => 'required|date',
        'start_time' => 'required',
        'guide_id' => 'nullable|required|exists:users,id',
        'end_time' => 'required',
        'meal' => 'required|string',
'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        // 'destination_id' => 'required|exists:destinations,id', // Ensure this field is validated
        // 'day_of_week' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday', // Validate the day of the week
    ]);

    // dd($package);

    // حفظ البيانات
       $package= Package::create([
        'title' => $request->title,
        'description' => $request->description,
        'type' => $request->type,
        'max_people' => $request->max_people,
        'meal' => $request->meal,
        'price' => $request->price,
        'has_hotel' => $request->has('has_hotel') ? 1 : 0,
        'hotel_name' => $request->hotel_name ?? null,
        'hotel_rating' => $request->hotel_rating ?? null,
        'has_museum' => $request->has('has_museum') ? 1 : 0,
        'museum_name' => $request->museum_name  ?? null,
        'date' => $request->date,
        'guide_id' => $request->guide_id,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'destination_id' => 1,
        // 'destination_id' => $request->destination_id, // Adding the destination_id field
        // 'day_of_week' => $request->day_of_week, // Adding the day_of_week field
    ]);

    
        // إذا تم رفع صورة
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');

            // تخزين الصورة في جدول media
          Media::create([
    'package_id' => $package->id,
    'media' => $imagePath, // اسم الملف أو مساره اللي خزّنته
]);

        }

    session()->flash('success', ' package created successfully');
    return redirect()->route('admin.packages.index');
}



    // عرض تفاصيل 
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    // عرض نموذج تعديل الباقة
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // تحديث الباقة
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'is_active' => 'sometimes|boolean'
        ]);

        
      
        $validated['is_active'] = $request->has('is_active');

        $package->update($validated);
        
        return redirect()->route('admin.packages.index')
                       ->with('success', 'package updated successfully'); 
    }

   public function destroy($id)
{
    $package = Package::findOrFail($id);

    // حذف الحجوزات المرتبطة
    $package->bookings()->delete();

    // حذف الميديا، الأنشطة، العروض الخاصة، المراجعات، وغيره إذا بدك
    $package->media()->delete();
    $package->activities()->delete();
    $package->specialOffers()->delete();
    $package->reviews()->delete();

    // حذف الباقة
    $package->delete();

    return redirect()->back()->with('success', 'Package deleted successfully.');
}

}