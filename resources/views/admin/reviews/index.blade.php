@include('components.app')

<div class="main-content">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Review Management</h6>
            <div>
                <form method="GET" class="form-inline">
                    {{-- You can add search or filter inputs here if needed --}}
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Package/Destination</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
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
                                    <span class="text-muted">User not available</span>
                                @endisset
                            </td>
                            <td>
                                {{ $review->reviewable_type == 'App\Models\Package' ? 'Package' : 'Destination' }}
                            </td>
                            <td>
                                @if($review->reviewable_type == 'App\Models\Package')
                                    @isset($review->package->name)
                                        {{ $review->package->name }}
                                    @else
                                        <span class="text-muted">Package not available</span>
                                    @endisset
                                @else
                                    @isset($review->destination->name)
                                        {{ $review->destination->name }}
                                    @else
                                        <span class="text-muted">Destination not available</span>
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
