@php
    $projectName = strip_tags($project->name);
    $limitedName = Str::limit($projectName, 20, '...');
@endphp

<div class="card card-content col-lg-2 shadow-sm position-relative">
    <div class="card-header" style="height: 30px; border-bottom: none; background-color: var(--tbr-light-danger);">
    </div>
    <div class="d-flex px-7" style="margin-top: -15px;">
        <span class="svg-icon svg-icon-success bg-white rounded-circle shadow p-2">
            <i class="{{ $project->icon }} text-danger fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>
        </span>
    </div>
    <div class="card-body px-3" style="margin-top: -15px;">
        @if ($projectName !== $limitedName)
            <h6 class="fw-bold mb-2 text-gray-950 dark:text-white project-name">
                <button type="button"
                        class="btn p-0 border-0 bg-transparent fw-bold text-start"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="{{ $projectName }}">
                    {{ $limitedName }}
                </button>
            </h6>
        @else
            <h6 class="fw-bold mb-2 text-gray-950 dark:text-white project-name">
                {{ $projectName }}
            </h6>
        @endif
        <div class="d-flex align-items-center">
            <img src="{{ $project->user->photo_path ? asset($project->user->photo_path) : asset('assets/images/avatar.png') }}"
                    alt="{{ $project->user->name }}"
                    class="w-25px h-25px rounded-circle me-2 object-fit-cover">
            <span class="text-muted fs-8">{{ $project->user->name }}</span>
        </div>
    </div>
    <a href="{{ route('vision-boards.index', ['project_id' => $project->id]) }}"
        class="btn btn-icon btn-danger rounded-circle hover-btn m-3"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        title="Detail Proyek">
        <i class="ki-duotone ki-right-square fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
</div>
