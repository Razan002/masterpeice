@include('components.app')

<div class="main-content">
    <div class="form-card">
        <div class="card-header">
            <h3><i class="fas fa-user-edit"></i> Edit User: {{ $user->name }}</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ old('name', $user->name) }}" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">New Password (leave blank to keep current)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" 
                               value="{{ old('phone', $user->phone) }}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" 
                               value="{{ old('address', $user->address) }}">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="general_admin" {{ old('role', $user->role) == 'general_admin' ? 'selected' : '' }}>General Admin</option>
                        <option value="general_owner" {{ old('role', $user->role) == 'product_owner' ? 'selected' : '' }}>product Owner</option>
                        <option value="guide" {{ old('role', $user->role) == 'guide' ? 'selected' : '' }}>guide</option>

                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}> User</option>

                    </select>
                </div>
                
                <div class="form-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@push('styles')
<style>
    .form-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, #86B817 0%, #a3d133 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 10px 10px 0 0;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 1.5rem;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .form-footer {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #eee;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
    
    .alert {
        border-radius: 8px;
        margin-bottom: 2rem;
    }
</style>
@endpush