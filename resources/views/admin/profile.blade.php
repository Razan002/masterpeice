@include('components.app')


<style>
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .profile-card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }
    
    .card-header {
        background: linear-gradient(135deg, #86B817 0%, #86B817 100%);
        color: white;
        padding: 20px;
        border-bottom: none;
    }
    
    .card-title {
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
    }
    
    .avatar-container {
        text-align: center;
        margin: 25px 0;
    }
    
    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .avatar-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #f0f2f5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3.5rem;
        border: 5px solid white;
    }
    
    .form-section {
        padding: 25px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        border-radius: 6px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        width: 100%;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #86B817;
        box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
    }
    
    .btn {
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #86B817 0%, #111329 100%);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 115, 255, 0.3);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #86B817 0%, #86B817 100%);
        color: #212529;
    }
    
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    .section-divider {
        border-top: 1px solid #f0f0f0;
        margin: 30px 0;
        position: relative;
    }
    
    .section-title {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #28a745 0%, #5cb85c 100%);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 12px 15px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }
    
    .alert-success i {
        margin-right: 10px;
    }
    
    @media (max-width: 768px) {
        .profile-avatar, .avatar-placeholder {
            width: 120px;
            height: 120px;
        }
        
        .form-section {
            padding: 20px;
        }
    }
</style>
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
      
                <h1 class="mb-5">Admin Profile</h1>
            </div>
        </div>
    </div>
<div class="profile-container">
    <div class="profile-card">
        <div class="card-header">
            <h3 class="card-title">admin Profile</h3>
        </div>
        
        <div class="form-section">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ auth()->user()->name }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ auth()->user()->email }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
            
            <div class="section-divider"></div>
            
            <h5 class="section-title">Change Password</h5>
            <form method="POST" action="{{ route('admin.profile.password') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" 
                           name="current_password" required>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" 
                           name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" required>
                </div>
                
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-key"></i> Change Password
                </button>
            </form>
        </div>
    </div>
</div>