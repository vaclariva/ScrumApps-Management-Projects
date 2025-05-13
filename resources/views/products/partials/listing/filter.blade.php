@extends('include.default-filter')
@section('filter-id', $filterId)
@section('dt', $dt)
@section('filter-content-left')
    <div class="nav flex-column align-items-start gap-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active d-flex gap-2 flex-center text-nowrap" id="button-tab-visibility"
            data-bs-toggle="pill" data-bs-target="#tab-visibility" type="button" role="tab" aria-controls="tab-visibility"
            aria-selected="true">
            <span>Visibilitas</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
        <button class="nav-link  d-flex gap-2 flex-center text-nowrap" id="button-tab-category" data-bs-toggle="pill"
            data-bs-target="#tab-category" type="button" role="tab" aria-controls="tab-category" aria-selected="true">
            <span>Kategori</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
        <button class="nav-link  d-flex gap-2 flex-center text-nowrap" id="button-tab-type" data-bs-toggle="pill"
            data-bs-target="#tab-type" type="button" role="tab" aria-controls="tab-type" aria-selected="true">
            <span>Jenis Produk</span>
            <div class="tbr_filter--badge">
                <span>0</span>
            </div>
        </button>
    </div>
@endsection
@section('filter-content-right')
    <div class="tab-content" id="tab-visibility-content">
        <div class="tab-pane fade show active" id="tab-visibility" role="tabpanel" aria-labelledby="tab-visibility-tab"
            tabindex="0">
            @include('products.partials.listing.filter-search', ['filterId' => 'filter-visibility', 'type' => 'search'])
            <div class="mt-8 text-center tbr_search--result">
                <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                <div class="d-flex justify-content-between text-break">
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="b2b" data-text="B2B"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            B2B
                        </span>
                    </label>
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="visibility[]" value="b2c" data-text="B2C"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            B2C
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <div
            class="tab-pane fade"
            id="tab-category"
            role="tabpanel"
            aria-labelledby="tab-category-tab" tabindex="0"
        >
            @if ($categories->count() > 0)
                @include('products.partials.listing.filter-search', ['filterId' => 'filter-category', 'type' => 'search-more'])
                <div class="mt-8 text-center tbr_search--result">
                    <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                    <div class="row row-cols-2">
                        @foreach ($categories as $category)
                        <div @class(['col tbr_input--parent mb-4 in-load-more', 'd-none'=> $loop->iteration > 10])>
                            <label class="form-check form-check-inline d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" name="category[]"
                                    value="{{ $category->id }}" data-text="{{ $category->name }}"/>
                                <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                                    {{ $category->name }}
                                </span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div @class(['text-center tbr_search--more', 'd-none'=> count($categories) <= 10])>
                        <a type="button" class="fw-bold tbr_hover--opacity tbr_text--primary"
                            onclick="loadMoreFilter({el: this})" data-search-page='1'>
                            Lebih banyak
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center text-muted">Tidak ada data kategori yang tersedia</div>
            @endif
        </div>
        <div class="tab-pane fade" id="tab-type" role="tabpanel" aria-labelledby="tab-type-tab" tabindex="0">
            @include('products.partials.listing.filter-search', ['filterId' => 'filter-type', 'type' => 'search'])
            <div class="mt-8 text-center tbr_search--result">
                <span class="text-muted fw-semibold tbr_search--empty d-none">Kata kunci tidak ditemukan</span>
                <div class="d-flex justify-content-between text-break">
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="type[]" value="popular" data-text="Populer"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Populer
                        </span>
                    </label>
                    <label class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                        <input class="form-check-input" type="checkbox" name="type[]" value="pengembangan" data-text="Pengembangan"/>
                        <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                            Pengembangan
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
@endsection
