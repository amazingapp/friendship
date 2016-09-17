@if ($paginator->hasPages())
    <ul class="pager">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="previous disabled"><span>&larr; Newer</span></li>
        @else
            <li class="previous"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&larr; Newer</a></li>
        @endif

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Older &rarr;</a></li>
        @else
            <li class="next disabled"><span>Older&rarr;</span></li>
        @endif
    </ul>
@endif
