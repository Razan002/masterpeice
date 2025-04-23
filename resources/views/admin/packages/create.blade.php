@include('components.app')


<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 text-dark fw-bold mb-1">إضافة باقة سياحية جديدة</h1>
            <p class="text-muted mb-0">املأ النموذج لإنشاء باقة سياحية جديدة</p>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i> رجوع للقائمة
        </a>
    </div>

    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> معلومات الباقة الأساسية</h5>
        </div>
    
            
    
        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="row g-4">
                    <!-- العمود الأول -->
                    <div class="col-lg-6">
                        <!-- عنوان الباقة -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="أدخل عنوان الباقة" required>
                            <label for="title" class="text-muted">عنوان الباقة <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">يرجى إدخال عنوان الباقة</div>
                        </div>

                        <!-- الوصف -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" placeholder="أدخل وصف الباقة" style="height: 120px" required></textarea>
                            <label for="description" class="text-muted">الوصف <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">يرجى إدخال وصف الباقة</div>
                        </div>

                        <!-- نوع الباقة -->
                        <div class="mb-3">
                            <label for="type" class="form-label text-muted">نوع الباقة <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="type" name="type" required>
                                <option value="" selected disabled>اختر نوع الباقة</option>
                                <option value="adventure"><i class="fas fa-hiking me-2"></i> مغامرة</option>
                                <option value="heritage"><i class="fas fa-landmark me-2"></i> تراث</option>
                                <option value="cultural_food"><i class="fas fa-utensils me-2"></i> طعام ثقافي</option>
                                <option value="spiritual"><i class="fas fa-pray me-2"></i> روحاني</option>
                            </select>
                            <div class="invalid-feedback">يرجى اختيار نوع الباقة</div>
                        </div>
                    </div>

                    <!-- العمود الثاني -->
                    <div class="col-lg-6">
                        <!-- الحد الأقصى للأشخاص -->
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="max_people" name="max_people" placeholder="أدخل الحد الأقصى للأشخاص" min="1" required>
                            <label for="max_people" class="text-muted">الحد الأقصى للأشخاص <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">يرجى إدخال عدد صحيح موجب</div>
                        </div>

                        <!-- الوجبات -->
                        <div class="mb-3">
                            <label for="meal" class="form-label text-muted">نوع الوجبة</label>
                            <select class="form-select form-select-lg" id="meal" name="meal">
                                <option value="" selected>لا توجد وجبة</option>
                                <option value="Breakfast"><i class="fas fa-coffee me-2"></i> فطور</option>
                                <option value="Lunch"><i class="fas fa-hamburger me-2"></i> غداء</option>
                                <option value="Dinner"><i class="fas fa-moon me-2"></i> عشاء</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="guide_id" class="form-label text-muted">المرشد السياحي <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg" id="guide_id" name="guide_id" required>
                                <option value="" disabled selected>اختر المرشد السياحي</option>
                                @foreach($guides as $guide)
                                    <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">يرجى اختيار مرشد سياحي</div>
                        </div>

                        <!-- السعر -->
                        <div class="form-floating mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-money-bill-wave text-primary"></i></span>
                                <input type="number" step="0.01" class="form-control border-start-0" id="price" name="price" placeholder="السعر" min="0" required>
                                <span class="input-group-text bg-light">دينار</span>
                                <label for="price" class="text-muted">السعر <span class="text-danger">*</span></label>
                            </div>
                            <div class="invalid-feedback">يرجى إدخال سعر صحيح</div>
                        </div>
                    </div>
                </div>

                <!-- قسم الخيارات الإضافية -->
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="card border-primary mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-hotel text-primary me-2"></i> خيارات الإقامة</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="has_hotel" name="has_hotel" value="1">
                                    <label class="form-check-label" for="has_hotel">يشمل إقامة في فندق</label>
                                </div>
                                <div id="hotel_options" style="display: none;">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="hotel_name" name="hotel_name" placeholder="اسم الفندق">
                                        <label for="hotel_name">اسم الفندق</label>
                                    </div>
                                    <div class="form-floating">
                                        <select class="form-select" id="hotel_rating" name="hotel_rating">
                                            <option value="3">3 نجوم</option>
                                            <option value="4">4 نجوم</option>
                                            <option value="5">5 نجوم</option>
                                        </select>
                                        <label for="hotel_rating">تصنيف الفندق</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-info mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="fas fa-university text-info me-2"></i> زيارة المتاحف</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="has_museum" name="has_museum" value="1">
                                    <label class="form-check-label" for="has_museum">يشمل زيارة متحف</label>
                                </div>
                                <div id="museum_options" style="display: none;">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="museum_name" name="museum_name" placeholder="اسم المتحف">
                                        <label for="museum_name">اسم المتحف</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم التوقيت -->
                <div class="card border-success mt-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-clock text-success me-2"></i> توقيت الباقة</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="date" name="date" min="{{ date('Y-m-d') }}" required>
                                    <label for="date" class="text-muted">التاريخ <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">يرجى اختيار تاريخ صحيح</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                    <label for="start_time" class="text-muted">وقت البداية <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">يرجى تحديد وقت البداية</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                    <label for="end_time" class="text-muted">وقت النهاية <span class="text-danger">*</span></label>
                                    <div class="invalid-feedback">يرجى تحديد وقت النهاية</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- قسم الصور -->
                {{-- <div class="card border-warning mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-images text-warning me-2"></i> صور الباقة</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cover_image" class="form-label text-muted">الصورة الرئيسية <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="cover_image" name="cover_image" accept="image/*" required>
                            <div class="invalid-feedback">يرجى رفع صورة للباقة</div>
                            <div class="form-text">الصورة التي ستظهر كغلاف للباقة</div>
                        </div>
                        <div class="mb-3">
                            <label for="gallery_images" class="form-label text-muted">صور إضافية</label>
                            <input class="form-control" type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*">
                            <div class="form-text">يمكنك اختيار أكثر من صورة</div>
                        </div>
                    </div>
                </div> --}}
       
                <!-- زر الحفظ -->
                <div class="d-flex justify-content-between mt-5">
                    <button type="reset" class="btn btn-outline-danger rounded-pill px-4">
                        <i class="fas fa-trash-alt me-2"></i> مسح النموذج
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                       
                            <i class="fas fa-save me-2"></i> حفظ الباقة
                      
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // تفعيل التحقق من الصحة
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // إظهار/إخفاء خيارات الفندق
    document.getElementById('has_hotel').addEventListener('change', function() {
        const hotelOptions = document.getElementById('hotel_options');
        hotelOptions.style.display = this.checked ? 'block' : 'none';
        if (this.checked) {
            document.getElementById('hotel_name').required = true;
        } else {
            document.getElementById('hotel_name').required = false;
        }
    });

    // إظهار/إخفاء خيارات المتحف
    document.getElementById('has_museum').addEventListener('change', function() {
        const museumOptions = document.getElementById('museum_options');
        museumOptions.style.display = this.checked ? 'block' : 'none';
        if (this.checked) {
            document.getElementById('museum_name').required = true;
        } else {
            document.getElementById('museum_name').required = false;
        }
    });
</script>
