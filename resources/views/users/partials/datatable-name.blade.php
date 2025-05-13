<div class="d-flex align-items-center gap-4">
<img src="{{ $photo_path ?? ''}}" alt="" width="36" height="36" class="rounded-3 object-fit-cover">
    @if (auth()->user()->isSuperAdmin)
        <a href="{{ $url_edit ?? '' }}" class="text-primary">{{ $name }}</a>
    @else
        <span>{{ $name }}</span>
    @endif
</div>
