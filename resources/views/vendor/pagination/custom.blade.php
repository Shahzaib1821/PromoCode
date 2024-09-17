@if ($paginator->hasPages())
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><span class="prevv page-numbers disabled"><i class="fa fa-angle-left"></i></span></li>
        @else
            <li><a class="prevv page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span class="page-numbers">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><span class="page-numbers current">{{ $page }}</span></li>
                    @else
                        <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="nextt page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
        @else
            <li><span class="nextt page-numbers disabled"><i class="fa fa-angle-right"></i></span></li>
        @endif
    </ul>
@endif
