<ul class="nav nav-underline tbr_nav--tab">
    <li class="nav-item">
        <a class="nav-link {{ $activeIndex == 0 ? 'active' : '' }}" aria-current="page" href="{{ route('backlogs.index') }}">Backog</a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ $activeIndex == 1 ? 'active' : '' }}" aria-current="page" href="{{ route('inventories.minimumStock.index') }}">
            <span>Kelompok Backlog</span>
        </a>
    </li>
</ul>
