<nav role="navigation" aria-label="Pagination Navigation" class="pag-container">
    <div class="pagination">
        <div class="pag-info">
            {{-- Pagination Info--}}
            <span class="pagination-info">
                <span>{{ __('Showing:') }} <b>{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }} </b> {{ __('recipes') }}</span>
            </span><br>
        </div>
        <div class="pag-direct">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{--<span class="disabled">{{ __('Previous') }}</span> --}}
            @else
                <span>
                    <a href="{{ $paginator->previousPageUrl() . (request()->input('search-bar') ? '?search-bar=' . request()->input('search-bar') : '') }}" rel="prev" class="directpag">{{ __('Previous') }}</a>
                </span>
            @endif
        
        
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="disabled"><span>{{ $element }}</span></span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Add search query to pagination URLs --}}
                        @php
                            $urlWithSearch = $url . (request()->input('search-bar') ? '?search-bar=' . request()->input('search-bar') : '');
                        @endphp

                        @if ($page == $paginator->currentPage())
                            <span class="active"><span>{{ $page }}</span></span>
                        @else
                            <span><a href="{{ $urlWithSearch }}" class="directpag">{{ $page }}</a></span>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <span>
                    <a href="{{ $paginator->nextPageUrl() . (request()->input('search-bar') ? '?search-bar=' . request()->input('search-bar') : '') }}" rel="next" class="directpag">{{ __('Next') }}</a>
                </span>
            @else
                {{--<span class="disabled">{{ __('Next') }}</span> --}}
            @endif
        </div>
        {{-- Shows Which page are you on --}}
        <br>
        {{-- <span class="pagination-info">
            <span>{{ __('You are on Page: ') }} <b>{{ $paginator->currentPage() }}</b></span>
        </span><br> --}}
    </div>
</nav>
