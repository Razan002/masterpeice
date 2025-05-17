@include('components.header')

<div class="container-fluid py-5">
    <div class="container">
        <h1 class="display-5 mb-4">إنشاء حجز جديد</h1>
        
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">المستخدم</label>
                    <select class="form-select" id="user_id" name="user_id" required>
                        <option value="">اختر المستخدم</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="package_id" class="form-label">الباقة</label>
                    <select class="form-select" id="package_id" name="package_id">
                        <option value="">اختر الباقة (اختياري)</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="destination_id" class="form-label">الوجهة</label>
                    <select class="form-select" id="destination_id" name="destination_id">
                        <option value="">اختر الوجهة (اختياري)</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="booking_date" class="form-label">تاريخ الحجز</label>
                    <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="payment_method" class="form-label">طريقة الدفع</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="online">دفع إلكتروني</option>
                        <option value="on_spot">دفع عند الوصول</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="total_price" class="form-label">السعر الإجمالي</label>
                    <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" required>
                </div>
                
                <div class="col-12 mb-3">
                    <label for="custom_package_details" class="form-label">تفاصيل مخصصة</label>
                    <textarea class="form-control" id="custom_package_details" name="custom_package_details" rows="3"></textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">حفظ الحجز</button>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </div>
        </form>
    </div>
</div>

@include('components.footer')