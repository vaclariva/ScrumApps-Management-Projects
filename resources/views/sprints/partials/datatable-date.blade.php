<div class="flex justify-start items-center gap-3">
    <span>
        {{ $date && $date != '-' ? \Carbon\Carbon::parse($date)->translatedFormat('d F Y, H:i') : '-' }}
    </span>
</div>
