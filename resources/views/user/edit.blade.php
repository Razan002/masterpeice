<h1>تعديل بيانات المستخدم</h1>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">الاسم</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label for="email">البريد الإلكتروني</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="phone">رقم الهاتف</label>
    <input type="text" name="phone" value="{{ $user->phone }}">

    <label for="address">العنوان</label>
    <textarea name="address">{{ $user->address }}</textarea>

    <button type="submit">تحديث</button>
</form>
