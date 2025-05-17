@include('components.app')

<div class="main-content">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">إدارة التقييمات</h6>
            <div>
                <form method="GET" class="form-inline">
                    <div class="input-group mr-2">
                        <select name="type" class="form-control">
                            <option value="">كل التقييمات</option>
                            <option value="package" {{ request('type') == 'package' ? 'selected' : '' }}>تقييمات الباقات</option>
                            <option value="destination" {{ request('type') == 'destination' ? 'selected' : '' }}>تقييمات الوجهات</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="بحث..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>المستخدم</th>
                            <th>النوع</th>
                            <th>الباقة/الوجهة</th>
                            <th>التقييم</th>
                            <th>التعليق</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>
                                @isset($review->user->name)
                                    {{ $review->user->name }}
                                @else
                                    <span class="text-muted">مستخدم غير متاح</span>
                                @endisset
                            </td>
                            <td>
                                {{ $review->reviewable_type == 'App\Models\Package' ? 'باقة' : 'وجهة' }}
                            </td>
                            <td>
                                @if($review->reviewable_type == 'App\Models\Package')
                                    @isset($review->package->name)
                                        {{ $review->package->name }}
                                    @else
                                        <span class="text-muted">باقة غير متاحة</span>
                                    @endisset
                                @else
                                    @isset($review->destination->name)
                                        {{ $review->destination->name }}
                                    @else
                                        <span class="text-muted">وجهة غير متاحة</span>
                                    @endisset
                                @endif
                            </td>
                            <td>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>{{ Str::limit($review->comment, 50) }}</td>
                            <td>{{ $review->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>