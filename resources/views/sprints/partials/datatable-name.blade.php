<div class="d-flex align-items-center gap-4">
    @if (auth()->user()->isSuperAdmin || auth()->user()->isBusinessAnalyst)
    <a href="#"
        class="edit-name"
        data-id="{{ $sprint->id }}"
        data-name="{{ $sprint->name }}"
        data-description="{!! $sprint->description !!}"
        data-start_date="{{ $sprint->start_date }}"
        data-end_date="{{ $sprint->end_date }}"
        data-status="{{ $sprint->status }}"
        data-result_review="{!! $sprint->result_review !!}"
        data-result_retrospective="{!! $sprint->result_retrospective !!}">
        {{ $sprint->name }}
    </a>
    @else
        <span>{{ $sprint->name }}</span>
    @endif
</div>

