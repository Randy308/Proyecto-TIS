<!-- resources/views/livewire/custom-pagination.blade.php -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        {{-- Botón "Anterior" --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo; Anterior</span>
            </li>
        @else
            <li class="page-item">
                <button class="page-link" wire:click="previousPage" rel="prev" aria-label="Anterior">
                    <span aria-hidden="true">&laquo; Anterior</span>
                </button>
            </li>
        @endif

        {{-- Botones de páginas --}}
        @php
            $start = max(1, $paginator->currentPage() - 2);
            $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
        @endphp

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active">
                    <span class="page-link">{{ $i }}</span>
                </li>
            @else
                <li class="page-item">
                    <button class="page-link" wire:click="gotoPage({{ $i }})">{{ $i }}</button>
                </li>
            @endif
        @endfor

        {{-- Botón "Siguiente" --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button class="page-link" wire:click="nextPage" rel="next" aria-label="Siguiente">
                    <span aria-hidden="true">Siguiente &raquo;</span>
                </button>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Siguiente &raquo;</span>
            </li>
        @endif
    </ul>
</nav>
