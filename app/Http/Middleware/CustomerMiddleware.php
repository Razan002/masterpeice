<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق من أن المستخدم مسجل دخوله وهو من نوع 'customer'
        if (Auth::check() && Auth::user()->user_type == 'customer') {
            return $next($request);
        }

        // إذا لم يكن مؤهلاً، إعادة توجيه للصفحة الرئيسية مع رسالة
        return redirect('/')->with('error', 'ليس لديك صلاحية الوصول إلى هذه الصفحة');
    }
}