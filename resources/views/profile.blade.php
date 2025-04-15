@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="{{ asset('assets/img/user-profile.png') }}" 
                         class="rounded-circle mb-3" 
                         width="150" 
                         alt="Profile Image">
                    <h3>{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">معلومات التواصل</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
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
                        <button type="submit" class="btn btn-primary w-100">حفظ التعديلات</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">حجوزاتي</h5>
                </div>
                <div class="card-body">
                    @if($bookings->isEmpty())
                        <div class="alert alert-info">لا توجد حجوزات حتى الآن</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الوجهة/الباقة</th>
                                        <th>التاريخ</th>
                                        <th>السعر</th>
                                        <th>الحالة</th>
                                        <th>إجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($booking->package)
                                                {{ $booking->package->name }}
                                            @elseif($booking->destination)
                                                {{ $booking->destination->name }}
                                            @endif
                                        </td>
                                        <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                        <td>{{ $booking->total_price }} JOD</td>
                                        <td>
                                            <span class="badge 
                                                @if($booking->status == 'confirmed') bg-success
                                                @elseif($booking->status == 'cancelled') bg-danger
                                                @else bg-warning @endif">
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($booking->status != 'cancelled' && now()->diffInDays($booking->booking_date) >= 2)
                                            <form action="{{ route('profile.booking.cancel', $booking->id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('هل أنت متأكد من إلغاء هذا الحجز؟')">
                                                    إلغاء
                                                </button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection