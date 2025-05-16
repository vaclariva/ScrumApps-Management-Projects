<div
    id="drawer_in_progress"
    class="bg-white shadow-lg rounded-lg overflow-hidden"
    data-kt-drawer="true"
    data-kt-drawer-activate="true"
    data-kt-drawer-toggle="#drawer_in_progress_button"
    data-kt-drawer-close="#drawer_in_progress_close"
    data-kt-drawer-width="500px"
>
    <div class="raw w-100">
        <div class="drawer-header border-bottom p-5 d-flex justify-content-between align-items-center">
            <h3 class="text-dark fw-bold mb-0">Proyek In Progress (Sedang Berjalan)</h3>
            <button id="kt_drawer_in_progress_close" class="btn btn-icon btn-sm btn-light btn-hover-light-danger">
                <i class="ki-duotone ki-cross fs-2"></i>
            </button>
        </div>

        <div class="drawer-body p-5 overflow-auto">
            @if($inProgress->isEmpty())
                <p class="text-muted">Belum ada proyek.</p>
            @else
                @foreach ($inProgress as $inProgressProject)
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px me-4">
                                <span class="symbol-label">
                                    <i class="ki-duotone {{ $inProgressProject->icon }} fs-2 text-warning">
                                        <span class="path1"></span><span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="mb-0 me-2">
                                <a href="#" class="fs-6 text-gray-800 fw-bolder">
                                    {{ $inProgressProject->name }}
                                </a>
                                <div class="text-gray-500 fs-7">
                                    {{ \Carbon\Carbon::parse($inProgressProject->start_date)->locale('id')->translatedFormat('d F Y') ?? '-' }} -
                                    {{ \Carbon\Carbon::parse($inProgressProject->end_date)->locale('id')->translatedFormat('d F Y') ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
