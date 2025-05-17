{{-- resources/views/pagination/custom.blade.php --}}
@if ($paginator->hasPages())
    <nav class="pagination-container">
        <ul class="pagination">
            {{-- زر السابق --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">< Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">< Previous</a>
                </li>
            @endif

            {{-- زر التالي --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next ></a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next ></span>
                </li>
            @endif
        </ul>
    </nav>
@endif