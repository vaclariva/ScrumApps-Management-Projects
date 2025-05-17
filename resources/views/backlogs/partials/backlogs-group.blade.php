@php
    $sprints = $sprints ?? collect();
    $checkBacklogs = $checkBacklogs ?? [];
@endphp

<div class="card shadow-sm mb-3">
    <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse" data-bs-target="#kt_docs_card_collapsible">
        <h3 class="card-title">{{ $sprintName }}</h3>
        <div class="card-toolbar rotate-180">
            <i class="ki-duotone ki-down fs-1"></i>
        </div>
    </div>
    <div id="kt_docs_card_collapsible" class="collapse show">
        <div class="card-body">
            @foreach ($backlogs as $backlog)
                <div id="backlog_card_{{ $backlog->id }}" class="card shadow-sm mb-6" >
                    <div class="card-header">
                        <h3 class="card-title fs-5"> {{ $backlog->name }} </h3>
                    </div>
                    <div class="card-body" style="padding-top: 8px !important; padding-bottom: 8px !important;">
                        <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
                            <div class="d-flex gap-5 align-items-center">
                                @include('backlogs.partials.backlogs-priority')
                                @if($backlog->description)
                                    <i class="ki-duotone ki-text-align-justify-center fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                @endif
                                @if ($backlog->sprint_id && $backlog->sprint)
                                    <div class="d-flex align-items-center text-muted gap-1">
                                        <i class="ki-duotone ki-time fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="fs-7">{{ $backlog->sprint->name }}</span>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-check-square text-success fs-2 gap-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <span class="text-success">3/3</span>
                                </div>
                                @if ($backlog->status === 'active')
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="ki-duotone ki-medal-star text-success fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                        <span class="text-success">Selesai</span>
                                    </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    @if ($project?->user)
                                        <img src="{{ $project->user->photo_path ? asset($project->user->photo_path) : asset('assets/images/avatar.png') }}"
                                            alt="{{ $project->user->name }}"
                                            class="w-25px h-25px rounded-circle me-2 object-fit-cover">
                                        <span class="text-muted fs-7">{{ $project->user->name }}</span>
                                    @else
                                        <img src="{{ asset('assets/images/avatar.png') }}"
                                            alt="Tidak diketahui"
                                            class="w-25px h-25px rounded-circle me-2 object-fit-cover">
                                        <span class="text-muted fs-7">Tidak diketahui</span>
                                    @endif
                                </div>
                            </div>
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
                                        <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded btn-edit-backlog"
                                            data-id="{{ $backlog->id }}"
                                            data-name="{{ $backlog->name }}"
                                            data-description="{{ $backlog->description }}"
                                            data-priority="{{ $backlog->priority }}"
                                            data-status="{{ $backlog->status }}"
                                            data-sprint-id="{{ $backlog->sprint_id }}"
                                            data-applicant="{{ $backlog->applicant }}"
                                            data-project-id="{{ $backlog->project_id }}"
                                            data-user-id="{{ $backlog->user_id }}"
                                            data-user-name="{{ $project->user->name }}"
                                            data-user-photo="{{ $project->user->photo_path }}"
                                            data-check-backlogs='@json($backlog->checkBacklogs)'>
                                            Edit Backlog
                                        </a>
                                    </div>
                                    <div class="menu-item px-4">
                                        <a href="{{ route('backlogs.duplicate') }}" class="menu-link px-3 bg-hover-light-secondary rounded">Duplikat Backlog</a>
                                    </div>
                                    <div class="menu-item px-4">
                                        <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded"
                                        onclick="defaultDelete('{{ route('backlogs.destroy', $backlog->id) }}')">
                                        Hapus Backlog
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
