@extends('include.default-filter')
@section('filter-id', $filterId)
@section('dt', $dt)
@section('filter-content-left')
    <div class="nav flex-column align-items-start gap-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active d-flex gap-2 flex-center text-nowrap" id="button-tab-group"
            data-bs-toggle="pill" data-bs-target="#tab-group" type="button" role="tab" aria-controls="tab-group"
            aria-selected="true">
            <span>Role</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
    </div>
@endsection
@section('filter-content-right')
    <div class="tab-content" id="tab-visibility-content">
        <div class="tab-pane fade show active" id="tab-user" role="tabpanel" aria-labelledby="tab-user-tab" tabindex="0">
            @include('sprints.partials.filter-search', ['filterId' => 'filter-user', 'type' => 'search'])
            <div class="mt-8 text-center tbr_search--result">
                <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                <div class="d-flex justify-content-between gap-5 text-break">
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="role[]" value="BusinessAnalyst" data-text="BusinessAnalyst"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Business Analyst
                        </span>
                    </label>
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="role[]" value="TeamDeveloper" data-text="TeamDeveloper"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Team Developer
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection
