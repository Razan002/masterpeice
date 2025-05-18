@include('components.app')

<!-- Main Content -->
<div class="main-content">
    <div>
    <h1>Admin Dashboard</h1>
    </div>
    
    <!-- Statistics Cards -->
    <div class="stats-row">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">{{ $usersCount }}</h3>
                <p class="stat-title">Total Users</p>
                <span class="stat-change positive">
                    {{-- <i class="fas fa-arrow-up"></i> {{ $usersGrowth }}% --}}
                </span>
            </div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">{{ $bookingsCount }}</h3>
                <p class="stat-title">New Bookings</p>
                <span class="stat-change positive">
                    {{-- <i class="fas fa-arrow-up"></i> {{ $bookingsGrowth }}% --}}
                </span>
            </div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-box-open"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">{{ $packagesCount }}</h3>
                <p class="stat-title">Available Packages</p>
                <span class="stat-change positive">
                    {{-- <i class="fas fa-arrow-up"></i> {{ $packagesGrowth }}% --}}
                </span>
            </div>
        </div>
        
        <div class="stat-card danger">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-value">{{ $reviewsCount }}</h3>
                <p class="stat-title">New Reviews</p>
                {{-- <span class="stat-change {{ $reviewsGrowth >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $reviewsGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($reviewsGrowth) }}%
                </span> --}}
            </div>
        </div>
    </div>

 <!-- Charts -->
<div class="charts-row">
    <div class="chart-card">
        <div class="card-header">
            <h3><i class="fas fa-chart-line"></i> Monthly Bookings Statistics</h3>
        </div>
        <div class="card-body">
<canvas id="monthlyBookingsChart"></canvas> <!-- شارت الإحصائيات الشهرية -->

        </div>
    </div>
    
    <div class="chart-card">
        <div class="card-header">
            <h3><i class="fas fa-chart-pie"></i> Bookings Distribution by Package</h3>
        </div>
        <div class="card-body">
<canvas id="packageDistributionChart"></canvas> <!-- شارت التوزيع -->

        </div>
    </div>
</div>

    <!-- Recent Bookings -->
    <div class="recent-card">
        <div class="card-header">
            <h3><i class="fas fa-history"></i> Recent Bookings</h3>
            <a href="{{ route('admin.bookings') }}" class="view-all">View All <i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Package</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->package->name }}</td>
                            <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span class="status-badge {{ $booking->status }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const bookingStats = @json($bookingStats);
        const packageDistribution = @json($packageDistribution);

        console.log(bookingStats);
        console.log(packageDistribution);

        // الرسم الأول
        const ctx1 = document.getElementById('monthlyBookingsChart');
        if (ctx1) {
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: bookingStats.months,
                    datasets: [{
                        label: ' booking count',
                        data: bookingStats.counts,
                        borderColor: '#283046',
                        backgroundColor: 'rgba(20, 100, 100, 0.1)',
                        borderWidth: 1,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }

        // الرسم الثاني
        const ctx2 = document.getElementById('packageDistributionChart');
        if (ctx2) {
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: packageDistribution.map(item => item.name),
                    datasets: [{
                        label: 'bookings count',
                        data: packageDistribution.map(item => item.bookings_count),
                        backgroundColor: [
                            '#86B817', '#283046', '#FFCE56', '#8BC34A', '#FF9800'
                        ]
                    }]
                }
            });
        }
    });
</script>
<style>
    /* تنسيقات عامة للـ Charts */
    .charts-row {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .chart-card {
        flex: 1;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .card-header {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        background: #f8f9fa;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 16px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .card-header h3 i {
        color: #7367F0;
    }
    
    .card-body {
        padding: 20px;
        flex: 1;
       
        height: 60%;
    }
    
    /* تنسيقات خاصة بالـ Charts */
    .chart-card canvas {
        width: 80% !important;
        height: 60% !important;
    }
    
    /* تنسيقات للعرض على الشاشات الصغيرة */
    @media (max-width: 768px) {
        .charts-row {
            flex-direction: column;
        }
    }
</style>


