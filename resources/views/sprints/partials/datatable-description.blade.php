<div class="flex justify-start items-center gap-3" data-tooltip="#tooltip_description{{ $sprint->id }}" data-tooltip-placement="bottom">
    {!! $sprint->description ? Str::limit($sprint->description, 20) : '-' !!}
</div>
