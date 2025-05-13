<div class="flex justify-center items-center gap-3">
    <span
        class="badge badge-circle badge-{{ $sprint->status == 'active' ? 'success' : 'warning' }}"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="{{ $sprint->status == 'active' ? 'Selesai' : 'Sedang berjalan' }}">
    </span>
</div>
