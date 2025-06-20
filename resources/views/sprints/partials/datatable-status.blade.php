<div class="flex justify-center items-center gap-3">
    <span
        class="badge badge-{{ $sprint->status == 'active' ? 'success' : 'warning' }} badge-lg">
        {{ $sprint->status == 'active' ? 'Selesai' : 'Sedang berjalan' }}
    </span>
</div>
