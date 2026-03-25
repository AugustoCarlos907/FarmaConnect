@if ($paginator->hasPages())
  <div style="display:flex;align-items:center;justify-content:space-between;width:100%;flex-wrap:wrap;gap:8px;">

    {{-- Info --}}
    <span style="font-size:0.75rem;color:var(--text-3)">
      {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
      de {{ $paginator->total() }}
    </span>

    {{-- Botões --}}
    <div class="pagination">

      {{-- Anterior --}}
      @if ($paginator->onFirstPage())
        <button class="pg-btn" disabled>
          <i class="bi bi-chevron-left" style="font-size:.65rem"></i>
        </button>
      @else
        <a href="{{ $paginator->previousPageUrl() }}" class="pg-btn">
          <i class="bi bi-chevron-left" style="font-size:.65rem"></i>
        </a>
      @endif

      {{-- Páginas --}}
      @php
        $current  = $paginator->currentPage();
        $last     = $paginator->lastPage();
        $window   = 2; /* páginas de cada lado da actual */
        $pages    = [];

        /* Sempre mostra 1 */
        $pages[] = 1;

        /* Reticências antes? */
        if ($current - $window > 2) $pages[] = '…';

        /* Janela em volta da página actual */
        for ($p = max(2, $current - $window); $p <= min($last - 1, $current + $window); $p++) {
          $pages[] = $p;
        }

        /* Reticências depois? */
        if ($current + $window < $last - 1) $pages[] = '…';

        /* Sempre mostra última (se > 1) */
        if ($last > 1) $pages[] = $last;
      @endphp

      @foreach($pages as $page)
        @if($page === '…')
          <span class="pg-ellipsis">…</span>
        @elseif($page == $current)
          <button class="pg-btn active" disabled>{{ $page }}</button>
        @else
          <a href="{{ $paginator->url($page) }}" class="pg-btn">{{ $page }}</a>
        @endif
      @endforeach

      {{-- Próxima --}}
      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pg-btn">
          <i class="bi bi-chevron-right" style="font-size:.65rem"></i>
        </a>
      @else
        <button class="pg-btn" disabled>
          <i class="bi bi-chevron-right" style="font-size:.65rem"></i>
        </button>
      @endif

    </div>
  </div>
@endif