<div class="d-flex align-items-center gap-4">
    @if (auth()->user()->isSuperAdmin || auth()->user()->isBusinessAnalyst)
    <a href="#"
        class="edit-team"
        data-id="{{ $team->id }}"
        data-user-id="{{ $team->user_id }}"
        data-role="{{ $team->role }}">
        {{ $team->user->name }}
    </a>
    @else
        <span>{{ $team->user->name }}</span>
    @endif
</div>

