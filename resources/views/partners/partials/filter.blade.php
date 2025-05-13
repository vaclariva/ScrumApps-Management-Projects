@extends('include.default-filter')
@section('filter-id', $filterId)
@section('dt', $dt)
@section('filter-content-left')
    <div class="nav flex-column align-items-start gap-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active d-flex gap-2 flex-center text-nowrap" id="button-tab-group"
            data-bs-toggle="pill" data-bs-target="#tab-group" type="button" role="tab" aria-controls="tab-group"
            aria-selected="true">
            <span>Kelompok</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
        <button class="nav-link d-flex gap-2 flex-center text-nowrap" id="button-tab-regency"
            data-bs-toggle="pill" data-bs-target="#tab-regency" type="button" role="tab" aria-controls="tab-regency"
            aria-selected="false">
            <span>Kota/Kab</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
        <button class="nav-link d-flex gap-2 flex-center text-nowrap" id="button-tab-status" data-bs-toggle="pill"
            data-bs-target="#tab-status" type="button" role="tab" aria-controls="tab-status" aria-selected="false">
            <span>Status</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
    </div>
@endsection
@section('filter-content-right')
    <div class="tab-content" id="tab-visibility-content">
        <div class="tab-pane fade show active" id="tab-group" role="tabpanel" aria-labelledby="tab-group-tab" tabindex="0">
            @include('products.partials.listing.filter-search', ['filterId' => 'filter-group', 'type' => 'search'])
            <div class="mt-8 text-center tbr_search--result">
                <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                <div class="d-flex justify-content-between gap-5 text-break">
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="group[]" value="regular" data-text="Reguler"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Reguler
                        </span>
                    </label>
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="group[]" value="Star" data-text="Star"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Star
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div
            class="tab-pane fade"
            id="tab-regency"
            role="tabpanel"
            aria-labelledby="tab-regency-tab" tabindex="0"
        >
            @if ($regencies->count() > 0)
                @include('products.partials.listing.filter-search', ['filterId' => 'filter-regency', 'type' => 'search-more'])
                <div class="mt-8 text-center tbr_search--result">
                    <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                    <div class="row row-cols-2">
                        @foreach ($regencies as $regency)
                        <div @class(['col tbr_input--parent mb-4 in-load-more', 'd-none'=> $loop->iteration > 10])>
                            <label class="form-check form-check-inline d-flex align-items-center ">
                                <input class="form-check-input" type="checkbox" name="regency[]"
                                    value="{{ $regency->id }}" data-text="{{ $regency->name }}"/>
                                <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                                    {{ $regency->name }}
                                </span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div @class(['text-center tbr_search--more', 'd-none'=> count($regencies) <= 10])>
                        <a type="button" class="fw-bold tbr_hover--opacity tbr_text--primary"
                            onclick="loadMoreFilter({el: this})" data-search-page='1'>
                            Lebih banyak
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center text-muted">Tidak ada data lokasi yang tersedia</div>
            @endif
        </div>
        <div class="tab-pane fade" id="tab-status" role="tabpanel" aria-labelledby="tab-status-tab" tabindex="0">
            @include('products.partials.listing.filter-search', ['filterId' => 'filter-status', 'type' => 'search'])
            <div class="mt-8 text-center tbr_search--result">
                <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                <div class="d-flex justify-content-between gap-5 text-break">
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="status[]" value="0" data-text="Nonaktif"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Nonaktif
                        </span>
                    </label>
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="status[]" value="1" data-text="Aktif"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Aktif
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection
