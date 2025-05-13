<div class="flex justify-start items-center gap-3">
    {!! $result ? Str::limit(strip_tags($result), 20, '...') : '-' !!}
</div>
