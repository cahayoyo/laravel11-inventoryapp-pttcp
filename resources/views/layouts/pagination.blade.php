@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <a href="#" class="pagination-btn disabled">&laquo; Previous</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">&laquo; Previous</a>
        @endif

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <a href="#" class="pagination-btn active">{{ $page }}</a>
            @else
                <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">Next &raquo;</a>
        @else
            <a href="#" class="pagination-btn disabled">Next &raquo;</a>
        @endif
    </div>
@endif
