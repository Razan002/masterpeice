@include('components.app')

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 text-dark fw-bold mb-1">تعديل الباقة: {{ $package->title }}</h1>
            <p class="text-muted mb-0">قم بتعديل بيانات الباقة السياحية</p>
        </div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i> رجوع للقائمة
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> تعديل الباقة</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- العمود الأول -->
                    <div class="col-lg-6">
                        <!-- عنوان الباقة -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title', $package->title) }}" placeholder="أدخل عنوان الباقة" required>
                            <label for="title" class="text-muted">عنوان الباقة <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">يرجى إدخال عنوان الباقة</div>
                        </div>

                        <!-- الوصف -->
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" 
                                      placeholder="أدخل وصف الباقة" style="height: 120px" required>{{ old('description', $package->description) }}</textarea>
                            <label for="description" class="text-muted">الوصف <span class="text-danger">*</span></label>
                            <div class="invalid-feedback">يرجى إدخال وصف الباقة</div>
                        </div>
                    </div>

                    <!-- العمود الثاني -->
                    <div class="col-lg-6">
                        <!-- السعر -->
                        <div class="form-floating mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-money-bill-wave text-primary"></i></span>
                                <input type="number" step="0.01" class="form-control border-start-0" id="price" name="price" 
                                       value="{{ old('price', $package->price) }}" placeholder="السعر" min="0" required>
                                <span class="input-group-text bg-light">دينار</span>
                                <label for="price" class="text-muted">السعر <span class="text-danger">*</span></label>
                            </div>
                            <div class="invalid-feedback">يرجى إدخال سعر صحيح</div>
                        </div>

                        <!-- حالة الباقة -->
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ $package->is_active ? 'checked' : '' }} value="1">
                            <label class="form-check-label" for="is_active">الباقة مفعلة</label>
                        </div>
                    </div>
                </div>

                <!-- زر الحفظ -->
                <div class="d-flex justify-content-between mt-5">
                    <button type="reset" class="btn btn-outline-danger rounded-pill px-4">
                        <i class="fas fa-trash-alt me-2"></i> مسح التعديلات
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save me-2"></i> حفظ التعديلات
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
</script>