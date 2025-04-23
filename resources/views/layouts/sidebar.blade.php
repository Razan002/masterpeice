<div class="sidebar">
    <!-- Sidebar Title -->
    <div class="sidebar-brand">
        <i class="fas fa-cogs me-2"></i>
        Admin Dashboard
    </div>
    
    <!-- Navigation Menu -->
    <div class="px-3 py-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
             
            <li class="nav-item">
                <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Packages</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Bookings</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Reviews</span>
                </a>
            </li>
{{--             
            <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
