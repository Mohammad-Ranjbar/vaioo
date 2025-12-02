
<div class="card-footer d-flex justify-content-center">
@if (isset($paginator) && $paginator->lastPage() > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end mb-0">
            <li class="page-item {{ ($paginator->onFirstPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ !$paginator->onFirstPage() ? $paginator->previousPageUrl() : 'javascript:void(0);' }}">
                    قبلی
                </a>
            </li>
            @php
                $halfTotalLinks = floor(7 / 2);
                $from = $paginator->currentPage() - $halfTotalLinks;
                $to = $paginator->currentPage() + $halfTotalLinks;

                if ($paginator->currentPage() < $halfTotalLinks) {
                    $to += $halfTotalLinks - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $halfTotalLinks) {
                    $from -= $halfTotalLinks - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
            @endphp

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($from < $i && $i < $to)
                    <li class="page-item {{ ($paginator->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endif
            @endfor
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? 'disabled' : '' }}">
                <a class="page-link" href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'javascript:void(0);' : $paginator->nextPageUrl() }}">
                    بعدی
                </a>
            </li>
        </ul>
    </nav>
@endif
</div>
