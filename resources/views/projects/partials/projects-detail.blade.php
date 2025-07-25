<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start align-items-center flex-wrap">
            <div class="">
                <div class="d-flex align-items-center gap-3 mb-5">
                    <i class="{{ $project->icon }} fs-1 tbr_text--primary">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <h3 class="fw-bolder mb-0"> {{ $project->name }} </h3>
                    @switch($project->status)
                        @case('hold')
                            <span class="badge badge-light-secondary">Hold</span>
                            @break
                        @case('done')
                            <span class="badge badge-light-success">Done</span>
                            @break
                        @case('late')
                            <span class="badge badge-light-danger">Late</span>
                            @break
                        @case('in progress')
                            <span class="badge badge-light-warning">In Progress</span>
                            @break
                        @default
                            <span class="badge badge-light-secondary">{{ ucfirst($project->status) }}</span>
                    @endswitch
                </div>

                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="d-flex align-items-center">
                        <img src="{{ $project->user->photo_path ? asset($project->user->photo_path) : asset('assets/images/avatar.png') }}"
                            alt="{{ $project->user->name }}"
                            class="w-25px h-25px rounded-circle me-2 object-fit-cover">
                        <span class="text-muted fs-7">{{ $project->user->name }}</span>
                    </div>
                    <span class="tbr_text--primary">•</span>
                    <span class="badge badge-danger">
                        {{ $project->label === 'internal' ? 'Internal' : ($project->label === 'external' ? 'Eksternal' : ucfirst($project->label)) }}
                    </span>
                    <span class="tbr_text--primary">•</span>
                    <span class="text-muted">
                        {{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('d F Y, H:i') }} -
                        {{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('d F Y, H:i') }}
                    </span>
                </div>
            </div>
            @if (auth()->user()->isSuperAdmin || auth()->user()->isBusinessAnalyst)
                <div>
                    <button type="button"
                        class="btn btn-icon tbr_btn--primary rotate"
                        data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end"
                        data-kt-menu-offset="0px, 0px">

                        <i class="ki-duotone ki-dots-circle-vertical tbr_text--primary fs-2qx rotate-90">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px mw-300px py-4 px-2"
                        data-kt-menu="true">

                        <div class="menu-item px-4">
                            <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded" data-bs-toggle="modal"
                                data-bs-target="#modal_edit_project">Edit Proyek</a>
                        </div>
                        <div class="menu-item px-4">
                            <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded"
                            onclick="defaultDelete('{{ route('projects.destroy', $project->id) }}')">
                            Hapus Proyek
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
