<h1>Edit User Information</h1>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Name</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="phone">Phone Number</label>
    <input type="text" name="phone" value="{{ $user->phone }}">

    <label for="address">Address</label>
    <textarea name="address">{{ $user->address }}</textarea>

    <button type="submit">Update</button>
</form>
