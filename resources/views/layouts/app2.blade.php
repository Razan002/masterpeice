<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Product Owner Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #19232e;
            --sidebar-color: #fff;
            --sidebar-active-bg: #6f991c;
            --sidebar-hover-bg: #162534;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        #sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-color);
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 12px 20px;
            display: block;
            color: var(--sidebar-color);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        #sidebar ul li a:hover {
            background: var(--sidebar-hover-bg);
            color: #fff;
        }
        
        #sidebar ul li.active > a {
            background: var(--sidebar-active-bg);
            color: #fff;
        }
        
        #sidebar ul li a i {
            margin-right: 10px;
        }
        
        #content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .dropdown-toggle::after {
            display: block;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-primary {
    background-color: #6f991c;
    border-color: #6f991c;
}

        
        .sidebar-dropdown .dropdown-menu {
            position: relative !important;
            transform: none !important;
            top: 0 !important;
            float: none;
            width: 100%;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            box-shadow: none;
        }
        
        .sidebar-dropdown .dropdown-menu a {
            padding-left: 30px;
            color: #ccc;
        }
        
        .sidebar-dropdown .dropdown-menu a:hover {
            color: #fff;
            background: var(--sidebar-hover-bg);
        }
        
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
            }
            #sidebarCollapse span {
                display: none;
            }
        }
        
        .user-profile {
            text-align: center;
            padding: 20px 0;
        }
        
        .user-profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }
        
        .user-profile h5 {
            margin-top: 10px;
            margin-bottom: 0;
        }
        
        .user-profile p {
            color: #adb5bd;
            font-size: 0.8rem;
        }
        .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

   
    .badge {
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 600;
        border-radius: 0.25rem;
        display: inline-block;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
    }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header" style="color:#6f991c ">
                <h3>SALTIST</h3>
            </div>
            
            <div class="user-profile">
              
                <h5>{{ Auth::user()->name }}</h5>
                <p>Product Owner</p>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('product_owner.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('product_owner.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('product_owner.products*') ? 'active' : '' }}">
                    <a href="#productsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-box-open"></i>
                        <span>Products</span>
                    </a>
                    <ul class="collapse list-unstyled" id="productsSubmenu">
                        <li>
                            <a href="{{ route('product_owner.products.index') }}">
                                <i class="fas fa-list"></i>
                                Product List
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product_owner.products.create') }}">
                                <i class="fas fa-plus-circle"></i>
                                Add New Product
                            </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('product_owner.products.low-stock') }}">
                                <i class="fas fa-exclamation-triangle"></i>
                                Low Stock
                            </a>
                        </li> --}}
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('product_owner.orders*') ? 'active' : '' }}">
                    <a href="#ordersSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="collapse list-unstyled" id="ordersSubmenu">
                        <li>
                            <a href="{{ route('product_owner.orders.index') }}" class="dropdown-item">
                                <i class="fas fa-shopping-cart"></i>
                                <span>All Orders</span>
                            </a>
                        </li>
                        <li>
                            {{-- <a href="{{ route('product_owner.orders.pending') }}">
                                <i class="fas fa-clock"></i>
                                Pending Orders
                            </a> --}}
                        </li>
                        <li>
                            {{-- <a href="{{ route('product_owner.orders.completed') }}">
                                <i class="fas fa-check-circle"></i>
                                Completed Orders
                            </a> --}}
                        </li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('product_owner.sales*') ? 'active' : '' }}">
                    <a href="#salesSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-chart-line"></i>
                        <span>Reports & Sales</span>
                    </a>
                    <ul class="collapse list-unstyled" id="salesSubmenu">
                        <li>
                            {{-- <a href="{{ route('product_owner.sales.daily') }}">
                                <i class="fas fa-calendar-day"></i>
                                Daily Sales
                            </a> --}}
                        </li>
                        <li>
                            {{-- <a href="{{ route('product_owner.sales.monthly') }}">
                                <i class="fas fa-calendar-alt"></i>
                                Monthly Sales
                            </a> --}}
                        </li>
                        <li>
                            {{-- <a href="{{ route('product_owner.sales.products') }}">
                                <i class="fas fa-star"></i>
                                Best Selling Products
                            </a> --}}
                        </li>
                    </ul>
                </li>
                
                {{-- <li class="{{ request()->routeIs('product_owner.reviews*') ? 'active' : '' }}">
                    <a href="{{ route('product_owner.reviews.index') }}">
                        <i class="fas fa-star-half-alt"></i>
                        <span>Reviews & Ratings</span>
                    </a>
                </li> --}}
                
                {{-- <li>
                    <a href="{{ route('product_owner.settings') }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li> --}}
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        
        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container-fluid">
                  
                    
                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-3">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                                <li><h6 class="dropdown-header">Recent Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">New Order #1254</a></li>
                                <li><a class="dropdown-item" href="#">New Review for Your Product</a></li>
                                <li><a class="dropdown-item" href="#">Low Stock for "Olive Oil"</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary" href="#">View All Notifications</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                {{-- <li><a class="dropdown-item" href="{{ route('product_owner.profile') }}"><i class="fas fa-user me-1"></i> Profile</a></li> --}}
                                {{-- <li><a class="dropdown-item" href="{{ route('product_owner.settings') }}"><i class="fas fa-cog me-1"></i> Settings</a></li> --}}
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Page Heading -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">@yield('page-title')</h1>
                @yield('breadcrumbs')
            </div>
            
            <!-- Main Content -->
            <div class="container-fluid">
                @include('partials.alerts')
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- jQuery, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function () {
            // Toggle sidebar
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            
            // Activate dropdowns
            $('ul.components li a.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                $(this).parent().toggleClass('active');
                $(this).next('.collapse').toggleClass('show');
            });
            
            // Highlight active menu item
            var current = location.pathname;
            $('#sidebar ul li a').each(function(){
                var $this = $(this);
                if($this.attr('href') === current || $this.attr('href').startsWith(current + '/')) {
                    $this.parent().addClass('active');
                    $this.closest('.collapse').addClass('show');
                    $this.closest('.dropdown-toggle').parent().addClass('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>