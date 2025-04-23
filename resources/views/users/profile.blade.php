@include('components.header')

<style>
    .profile-container {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 30px;
    }
    .profile-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .booking-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    .badge {
        padding: 8px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .bg-success {
        background-color: #1cc88a !important;
    }
    .bg-danger {
        background-color: #e74a3b !important;
    }
    .bg-warning {
        background-color: #f6c23e !important;
        color: #2a2a2a;
    }
    .btn-primary {
        background-color: #4e73df;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
    }
</style>

<div class="container py-5 profile-container">
    <!-- معلومات المستخدم -->
    <div class="card profile-card mb-4 text-center">
        <div class="card-body">
            <h3>{{ $user->name }}</h3>
            <p class="text-muted">{{ $user->email }}</p>
            <p>{{ $user->phone ?? 'لا يوجد رقم' }}</p>
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                تعديل المعلومات
            </button>
        </div>
    </div>

    <!-- الحجوزات -->
    <h4 class="mb-3">حجوزاتي</h4>

    @if($bookings->isEmpty())
        <div class="alert alert-info text-center py-4">لا توجد حجوزات حتى الآن</div>
    @else
        <div class="row">
            @foreach($bookings as $booking)
                <div class="col-md-6 mb-4">
                    <div class="card booking-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                @if($booking->package)
                                    {{ $booking->package->name }}
                                @elseif($booking->destination)
                                    {{ $booking->destination->name }}
                                @endif
                            </h5>
                            <p class="mb-1"><strong>التاريخ:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}</p>
                            <p class="mb-1"><strong>السعر:</strong> {{ $booking->total_price }} JOD</p>
                            <p class="mb-2">
                                <span class="badge
                                    @if($booking->status == 'confirmed') bg-success
                                    @elseif($booking->status == 'cancelled') bg-danger
                                    @else bg-warning @endif">
                                    {{ $booking->status }}
                                </span>
                            </p>

                            @if($booking->status != 'cancelled' && now()->diffInDays($booking->booking_date) >= 2)
                                <form action="{{ route('profile.booking.cancel', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('هل أنت متأكد من إلغاء هذا الحجز؟')">
                                        إلغاء الحجز
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal تعديل المعلومات -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">تعديل المعلومات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone ?? '' }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.footer')
