@if ($paginator->hasPages())
    <nav class="text-center m-auto">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item active">
                    <button class="page-link">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </button>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link"  href="{{ $paginator->nextPageUrl() }}">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </li>
            @else
                <li class="page-item active">
                    <button class="page-link" rel="next">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </li>
            @endif
        </ul>
    </nav>
@endif
