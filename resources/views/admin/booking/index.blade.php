@include('components.app')

<div class="main-content">
    <div class="recent-card">
        <div class="card-header">
            <h3><i class="fas fa-calendar-check"></i> Booking Management</h3>
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
                            <th>User Name</th>
                            <th>Package</th>
                            <th>Destination</th>
                            <th>Booking Date</th>
                            <th>Payment</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ substr($booking->user->name, 0, 1) }}
                                    </div>
                                    <span>{{ $booking->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="status-badge light">
                                    {{ $booking->package?->title ?? 'Custom' }}
                                </span>
                            </td>
                            <td>{{ $booking->destination?->name ?? 'Not specified' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</td>
                            <td>
                                @if($booking->payment_method == 'online')
                                    <span class="status-badge success">
                                        <i class="fas fa-check-circle me-1"></i> Online
                                    </span>
                                @else
                                    <span class="status-badge primary">
                                        <i class="fas fa-money-bill-wave me-1"></i> On Arrival
                                    </span>
                                @endif
                            </td>
                            <td>{{ number_format($booking->total_price, 2) }} $</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="status-badge warning">
                                        <i class="fas fa-clock me-1"></i> Pending
                                    </span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="status-badge success">
                                        <i class="fas fa-check-circle me-1"></i> Confirmed
                                    </span>
                                @else
                                    <span class="status-badge danger">
                                        <i class="fas fa-times-circle me-1"></i> Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="actions">
                               
                                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($bookings->isEmpty())
                <div class="no-data">
                    <img src="{{ asset('images/no-data.svg') }}" alt="No data available">
                    <h5>No bookings available</h5>
                </div>
                @endif
            </div>
            
            <div class="table-footer">
                <div class="table-info">
                    Showing <span>{{ $bookings->firstItem() }}</span> to <span>{{ $bookings->lastItem() }}</span> of <span>{{ $bookings->total() }}</span> bookings
                </div>
                <div class="table-pagination">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .main-content {
        padding: 20px;
    }
    
    .recent-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }
    
    .card-header h3 i {
        margin-right: 10px;
        color: #4e73df;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .recent-table thead {
        background-color: #f8f9fa;
    }
    
    .recent-table th {
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 1px solid #eee;
    }
    
    .recent-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    
    .recent-table tr:last-child td {
        border-bottom: none;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-weight: 600;
    }
    
    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-badge.success {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .status-badge.primary {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .status-badge.warning {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .status-badge.danger {
        background-color: #fee2e2;
        color: #b91c1c;
    }
    
    .status-badge.light {
        background-color: #f3f4f6;
        color: #374151;
    }
    
    .actions {
        display: flex;
        gap: 5px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }
    
    .btn-sm {
        width: 30px;
        height: 30px;
    }
    
    .btn-primary {
        background-color: #4e73df;
        color: white;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    
    .btn-danger {
        background-color: #e74a3b;
        color: white;
    }
    
    .no-data {
        text-align: center;
        padding: 40px 0;
    }
    
    .no-data img {
        height: 150px;
        margin-bottom: 20px;
    }
    
    .no-data h5 {
        color: #6c757d;
        font-weight: 400;
    }
    
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    
    .table-info {
        color: #6c757d;
        font-size: 14px;
    }
    
    .table-info span {
        font-weight: 600;
        color: #333;
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