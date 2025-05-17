@include('components.app')



<div class="main-content">
    <div class="recent-card">
        <div class="card-header">
            <h3><i class="fas fa-users"></i> User Management</h3>
            <a href="{{ route('admin.users.create') }}" class="view-all">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="status-badge {{ $user->role == 'general_admin' ? 'success' : ($user->role == 'product_owner' ? 'secondary' :   ($user->role == 'guide' ? 'primary' : 'warning'))  }}">
                                    {{ $user->role == 'general_admin' ? 'Admin' : ($user->role == 'product_owner' ? 'product_Owner' : ($user->role == 'guide' ? 'Guide' : ($user->role == 'User' ? 'user' : ''))) }}                                    {{ $user->role_name }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
</div>

<style>
    .status-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.success {
    background-color: #d1fae5;
    color: #065f46;
}

.status-badge.secondary {
    background-color: #f4d1fa;
    color: #06204d;
}

.status-badge.primary {
    background-color: #dbeafe;
    color: #1e40af;
}

.status-badge.warning {
    background-color: #fef3c7;
    color: #92400e;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
</style>