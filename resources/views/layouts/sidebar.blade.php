<div class="sidebar">
    <!-- Sidebar Title -->
    <div class="sidebar-brand">
        <i class="fas fa-cogs me-2"></i>
        <h3>{{ Auth::user()->name }}</h3>
    </div>
    
    <!-- Navigation Menu -->
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
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

            {{-- <li class="nav-item">
                <a href="{{ route('admin.destinations.index') }}" class="nav-link {{ request()->routeIs('admin.destinations*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-map-marker-alt"></i>
                    <span>Destinations</span>
                </a>
            </li> --}}
            
            <li class="nav-item">
                <a href="{{ route('admin.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Reviews</span>
                </a>
            </li>

            <li class="nav-item mt-4">
                <a href="{{ route('logout') }}" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>