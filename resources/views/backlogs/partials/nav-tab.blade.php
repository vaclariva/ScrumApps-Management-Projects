<ul class="nav nav-underline tbr_nav--tab">
    <li class="nav-item">
        <a class="nav-link {{ $activeIndex == 0 ? 'active' : '' }}" aria-current="page" href="{{ route('backlogs.index', ['project_id' => $project->id]) }}">Backlog</a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ $activeIndex == 1 ? 'active' : '' }}" aria-current="page" href="{{ route('backlogs.sprint-grouped', ['project_id' => $project->id]) }}">
            <span>Kelompok Backlog</span>
        </a>
    </li>
</ul>
