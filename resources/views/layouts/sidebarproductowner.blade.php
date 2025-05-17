<div class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh;">
    <!-- لوغو المتجر -->
    <div class="sidebar-header p-3 text-center border-bottom">
        <h4 class="mb-0">لوحة التحكم</h4>
        <small>مالك المنتجات</small>
    </div>

    <!-- قائمة التنقل -->
    <ul class="nav flex-column p-3">
        <!-- القسم الرئيسي -->
        <li class="nav-item">
            <a href="{{ route('product_owner.dashboard') }}" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i> النظرة العامة
            </a>
        </li>

        <!-- قسم المنتجات -->
        <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-box-open me-2"></i> المنتجات
            </a>
            <ul class="dropdown-menu bg-dark">
                <li>
                    <a href="{{ route('product_owner.products.index') }}" class="dropdown-item text-white">
                        <i class="fas fa-list me-2"></i> قائمة المنتجات
                    </a>
                </li>
                <li>
                    <a href="{{ route('product_owner.products.create') }}" class="dropdown-item text-white">
                        <i class="fas fa-plus-circle me-2"></i> إضافة منتج جديد
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-item text-white">
                        <i class="fas fa-chart-pie me-2"></i> تقارير المنتجات
                    </a>
                </li>
            </ul>
        </li>

        <!-- قسم الحجوزات -->
        <li class="nav-item">
            <a href="{{ route('product_owner.bookings.index') }}" class="nav-link text-white">
                <i class="fas fa-calendar-check me-2"></i> الحجوزات
                <span class="badge bg-primary float-end">5</span>
            </a>
        </li>

        <!-- قسم العملاء -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white">
                <i class="fas fa-users me-2"></i> العملاء
            </a>
        </li>

        <!-- قسم التقارير -->
        <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="reportsDropdown" role="button" data-bs-toggle="dropdown">
                <i class="fas fa-chart-line me-2"></i> التقارير
            </a>
            <ul class="dropdown-menu bg-dark">
                <li>
                    <a href="#" class="dropdown-item text-white">
                        <i class="fas fa-money-bill-wave me-2"></i> تقارير المبيعات
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-item text-white">
                        <i class="fas fa-star me-2"></i> تقييمات العملاء
                    </a>
                </li>
            </ul>
        </li>

        <!-- قسم الإعدادات -->
        <li class="nav-item">
            <a href="#" class="nav-link text-white">
                <i class="fas fa-cog me-2"></i> الإعدادات
            </a>
        </li>
    </ul>

    <!-- قسم المستخدم -->
    <div class="sidebar-footer p-3 border-top position-absolute bottom-0 w-100">
        <div class="d-flex align-items-center">
            <div>
                <small class="d-block">مالك المنتجات</small>
                <a href="#" class="text-white"><small>تسجيل الخروج</small></a>
            </div>
        </div>
    </div>
</div>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    .sidebar .nav-link {
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .sidebar .nav-link:hover, 
    .sidebar .nav-link.active {
        background-color: rgba(255,255,255,0.1);
    }
    .dropdown-menu {
        border: none;
        margin-left: 10px;
    }
    .dropdown-item:hover {
        background-color: rgba(255,255,255,0.1);
    }
</style>

<script>
    // تفعيل dropdowns في السايدبار
    document.addEventListener('DOMContentLoaded', function() {
        var dropdowns = document.querySelectorAll('.nav-item.dropdown');
        
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseenter', function() {
                var dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.classList.add('show');
            });
            
            dropdown.addEventListener('mouseleave', function() {
                var dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.classList.remove('show');
            });
        });
    });
</script>