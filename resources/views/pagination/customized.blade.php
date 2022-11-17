@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" style="margin:20px 0">
            @if (!$paginator->onFirstPage())
                <li class="page-item"><a class="page-link text-dark"
                        href="{{ $paginator->previousPageUrl() }}">{!! __('pagination.previous') !!}</a></li>
            @endif

            <!-- Elements Pagination-->

            @foreach ($elements as $element)
                <!-- Three dots separator "..." -->
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item">
                                <a class="page-link bg-danger" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <!-- ./ Three dots sepaator -->

            <!-- ./ Elements Pagination -->

            <!-- Next button if it has more pages! -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link text-dark"
                        href="{{ $paginator->nextPageUrl() }}">{!! __('pagination.next') !!}</a>
                </li>
            @endif

        </ul>
    </nav>
@endif
