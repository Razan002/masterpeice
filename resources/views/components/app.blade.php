<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Dashboard</title>
    
    <!-- الخطوط والأيقونات -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome للأيقونات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ملف الستايل -->
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="admin-body">
    <div class="container-fluid">
        <div class="row">
            <!-- تضمين السايدبار -->
            @include('layouts.sidebar')
            
            <!-- المحتوى الرئيسي -->
            <div class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                @yield('content')
                @yield('scripts')

            </div>
        </div>
    </div>

    <!-- زر تبديل السايدبار للجوال -->
    <button class="sidebar-toggle d-md-none btn btn-fire">
        <i class="fas fa-bars"></i>
    </button>

    <!-- السكربتات -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // تبديل السايدبار في الجوال
        $('.sidebar-toggle').click(function() {
            $('.sidebar').toggleClass('active');
        });
    </script>
    @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // مخطط الحجوزات الشهرية
        const bookingsCtx = document.getElementById('bookingsChart');
        if (bookingsCtx) {
            new Chart(bookingsCtx, {
                type: 'line',
                data: {
                    labels: @json($bookingStats['months'] ?? []),
                    datasets: [{
                        label: 'عدد الحجوزات',
                        data: @json($bookingStats['counts'] ?? []),
                        backgroundColor: 'rgba(134, 184, 23, 0.1)',
                        borderColor: 'rgba(134, 184, 23, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // مخطط توزيع الحجوزات حسب الباقات
       
        }
    );
</script>
@endsection
    @stack('scripts')
</body>
</html>