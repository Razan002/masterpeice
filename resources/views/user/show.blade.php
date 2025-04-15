<h1>بيانات المستخدم</h1>
<p>اسم: {{ $user->name }}</p>
<p>بريد إلكتروني: {{ $user->email }}</p>
<p>رقم الهاتف: {{ $user->phone }}</p>
<p>العنوان: {{ $user->address }}</p>

<a href="{{ route('user.edit', $user->id) }}">تعديل البيانات</a>
