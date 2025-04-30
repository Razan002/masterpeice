@include('components.app')




    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        <!-- بطاقات الإحصائيات -->
        <div class="stats-row">
            <div class="stat-card primary">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3 class="stat-value">{{ $usersCount }}</h3>
                    <p class="stat-title">إجمالي المستخدمين</p>
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
                    <p class="stat-title">الحجوزات الجديدة</p>
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
                    <p class="stat-title">الباقات المتاحة</p>
                    <span class="stat-change positive">
                        {{-- <i class="fas fa-arrow-up"></i> {{ $packagesGrowth }}% --}}
                    </span>
                </div>
            </div>
            
            <div class="stat-card danger">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                {{-- <div class="stat-info">
                    <h3 class="stat-value">{{ $reviewsCount }}</h3>
                    <p class="stat-title">التقييمات الجديدة</p>
                    <span class="stat-change {{ $reviewsGrowth >= 0 ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $reviewsGrowth >= 0 ? 'up' : 'down' }}"></i> {{ abs($reviewsGrowth) }}%
                    </span>
                </div> --}}
            </div>
        </div>

        <!-- الرسوم البيانية -->
        <div class="charts-row">
            <div class="chart-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-line"></i> إحصائيات الحجوزات الشهرية</h3>
                </div>
                <div class="card-body">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-pie"></i> توزيع الحجوزات حسب الباقات</h3>
                </div>
                <div class="card-body">
                    <canvas id="packagesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- أحدث الحجوزات -->
        <div class="recent-card">
            <div class="card-header">
                <h3><i class="fas fa-history"></i> أحدث الحجوزات</h3>
                <a href="{{ route('admin.bookings') }}" class="view-all">عرض الكل <i class="fas fa-arrow-left"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المستخدم</th>
                                <th>الباقة</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                            {{-- <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->package->name }}</td>
                                <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <span class="status-badge {{ $booking->status }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                            </tr> --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script>
    // مخطط الحجوزات الشهرية
    const bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
    const bookingsChart = new Chart(bookingsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($bookingStats['months']) !!},
            datasets: [{
                label: 'عدد الحجوزات',
                data: {!! json_encode($bookingStats['counts']) !!},
                backgroundColor: 'rgba(115, 103, 240, 0.1)',
                borderColor: 'rgba(115, 103, 240, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // // مخطط توزيع الحجوزات حسب الباقات
    // const packagesCtx = document.getElementById('packagesChart').getContext('2d');
    // // const packagesChart = new Chart(packagesCtx, {
    // //     type: 'doughnut',
    // //     data: {
    // //         labels: {!! json_encode($packageDistribution->pluck('name')) !!},
    // //         datasets: [{
    // //             data: {!! json_encode($packageDistribution->pluck('bookings_count')) !!},
    // //             backgroundColor: [
    // //                 'rgba(115, 103, 240, 0.8)',
    // //                 'rgba(40, 199, 111, 0.8)',
    // //                 'rgba(255, 159, 67, 0.8)',
    // //                 'rgba(234, 84, 85, 0.8)',
    // //                 'rgba(0, 207, 232, 0.8)'
    // //             ],
    // //             borderWidth: 0
    // //         }]
    // //     },
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         }
    //     }
    // });
</script> --}}
@endsection