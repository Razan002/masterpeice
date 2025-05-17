<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض قائمة المستخدمين
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // عرض نموذج الإنشاء
    public function create()
    {
        return view('admin.users.create');
    }

    // حفظ المستخدم الجديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => ['required', Rule::in(['general_admin', 'product_owner', 'user'])]
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => $validated['role']
        ]);

        return redirect()->route('admin.users.show', $user->id)
                       ->with('success', 'User created successfully!');
    }

    // عرض صفحة التعديل
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // تحديث بيانات المستخدم
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email'
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required'
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => $validated['role']
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                       ->with('success', 'User updated successfully!');
    }

    // حذف المستخدم
    public function destroy(User $user)
    {
        // منع حذف المستخدم إذا كان هو المدير الحالي
        if (Auth::id() == $user->id) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }

    // عرض تفاصيل المستخدم
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}