@extends('layouts.app')
@section('pageTitle', 'Stock Out')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Inventori', 'link' => route('inventories.index')],
            ['title' => 'Stok', 'link' => route('inventories.index')],
            ['title' => 'Stock Out', 'link' => '']
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('assets/css/inventories/stock-out.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/accordion.css') }}">
@endpush
@section('content')
    <div class="card">
        <form action="{{ route('inventories.store') }}" method="POST" class="tbr_main_form">
            <input type="text" name="type" value="Stock Out" hidden>
            <div class="card-header flex-column">
                <h5>Formulir Stock Out</h5>
                <span class="text-gray-600">Isi formulir dibawah untuk menambahkan stock out.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="name" class="h6 tbr_font--weight-bold mt-4">Pelaksana</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" value="{{ auth()->user()->name}}" name="name" id="name" disabled/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="date" class="h6 tbr_font--weight-bold mt-4">Tanggal</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group flex-root">
                            <span class="input-group-text">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z" fill="#A1A5B7"/>
                                    <path opacity="0.4" d="M20 9.84375C20.55 9.84375 21 10.2937 21 10.8438V17.0038C21 20.0038 19.5 22.0038 16 22.0038H8C4.5 22.0038 3 20.0038 3 17.0038V10.8438C3 10.2937 3.45 9.84375 4 9.84375H20Z" fill="#A1A5B7"/>
                                    <path d="M8.5 14.9989C8.24 14.9989 7.98 14.8889 7.79 14.7089C7.61 14.5189 7.5 14.2589 7.5 13.9989C7.5 13.7389 7.61 13.4789 7.79 13.2889C8.07 13.0089 8.51 12.9189 8.88 13.0789C9.01 13.1289 9.12 13.1989 9.21 13.2889C9.39 13.4789 9.5 13.7389 9.5 13.9989C9.5 14.2589 9.39 14.5189 9.21 14.7089C9.02 14.8889 8.76 14.9989 8.5 14.9989Z" fill="#A1A5B7"/>
                                    <path d="M12 14.9989C11.74 14.9989 11.48 14.8889 11.29 14.7089C11.11 14.5189 11 14.2589 11 13.9989C11 13.7389 11.11 13.4789 11.29 13.2889C11.38 13.1989 11.49 13.1289 11.62 13.0789C11.99 12.9189 12.43 13.0089 12.71 13.2889C12.89 13.4789 13 13.7389 13 13.9989C13 14.2589 12.89 14.5189 12.71 14.7089C12.66 14.7489 12.61 14.7889 12.56 14.8289C12.5 14.8689 12.44 14.8989 12.38 14.9189C12.32 14.9489 12.26 14.9689 12.2 14.9789C12.13 14.9889 12.07 14.9989 12 14.9989Z" fill="#A1A5B7"/>
                                    <path d="M15.5 15C15.24 15 14.98 14.89 14.79 14.71C14.61 14.52 14.5 14.26 14.5 14C14.5 13.74 14.61 13.48 14.79 13.29C14.89 13.2 14.99 13.13 15.12 13.08C15.3 13 15.5 12.98 15.7 13.02C15.76 13.03 15.82 13.05 15.88 13.08C15.94 13.1 16 13.13 16.06 13.17C16.11 13.21 16.16 13.25 16.21 13.29C16.39 13.48 16.5 13.74 16.5 14C16.5 14.26 16.39 14.52 16.21 14.71C16.16 14.75 16.11 14.79 16.06 14.83C16 14.87 15.94 14.9 15.88 14.92C15.82 14.95 15.76 14.97 15.7 14.98C15.63 14.99 15.56 15 15.5 15Z" fill="#A1A5B7"/>
                                    <path d="M8.5 18.5C8.37 18.5 8.24 18.47 8.12 18.42C7.99 18.37 7.89 18.3 7.79 18.21C7.61 18.02 7.5 17.76 7.5 17.5C7.5 17.24 7.61 16.98 7.79 16.79C7.89 16.7 7.99 16.63 8.12 16.58C8.3 16.5 8.5 16.48 8.7 16.52C8.76 16.53 8.82 16.55 8.88 16.58C8.94 16.6 9 16.63 9.06 16.67C9.11 16.71 9.16 16.75 9.21 16.79C9.39 16.98 9.5 17.24 9.5 17.5C9.5 17.76 9.39 18.02 9.21 18.21C9.16 18.25 9.11 18.3 9.06 18.33C9 18.37 8.94 18.4 8.88 18.42C8.82 18.45 8.76 18.47 8.7 18.48C8.63 18.49 8.57 18.5 8.5 18.5Z" fill="#A1A5B7"/>
                                    <path d="M12 18.5031C11.74 18.5031 11.48 18.3931 11.29 18.2131C11.11 18.0231 11 17.7631 11 17.5031C11 17.2431 11.11 16.9831 11.29 16.7931C11.66 16.4231 12.34 16.4231 12.71 16.7931C12.89 16.9831 13 17.2431 13 17.5031C13 17.7631 12.89 18.0231 12.71 18.2131C12.52 18.3931 12.26 18.5031 12 18.5031Z" fill="#A1A5B7"/>
                                    <path d="M15.5 18.5031C15.24 18.5031 14.98 18.3931 14.79 18.2131C14.61 18.0231 14.5 17.7631 14.5 17.5031C14.5 17.2431 14.61 16.9831 14.79 16.7931C15.16 16.4231 15.84 16.4231 16.21 16.7931C16.39 16.9831 16.5 17.2431 16.5 17.5031C16.5 17.7631 16.39 18.0231 16.21 18.2131C16.02 18.3931 15.76 18.5031 15.5 18.5031Z" fill="#A1A5B7"/>
                                </svg>
                            </span>
                            <input type="text" class="tbr_form form-control" name="date" id="date" value="" disabled/>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="warehouse" class="h6 tbr_font--weight-bold mt-4">Lokasi</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <select name="warehouse_id" class="tbr_form form-control form-select form-select-solid" id="warehouse_id" data-control="select2">
                            <option value="init" selected disabled>Pilih lokasi</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="align-middle">
                                <th>
                                    Produk
                                    <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                                </th>
                                <th>
                                    Stok
                                </th>
                                <th>
                                    Jumlah
                                    <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                                </th>
                                <th>
                                    Satuan
                                </th>
                                <th class="d-flex align-items-center justify-content-center border-0 gap-2">
                                    Koreksi
                                    <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tbr_tooltip--mw-fit" data-bs-title="<span class='fw-semibold'>Centang jika terjadi kesalahan <br/>memasukan jumlah stok.</span>" data-bs-html="true" data-bs-placement="bottom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M7.9974 1.33073C4.3155 1.33073 1.33073 4.3155 1.33073 7.99739C1.33073 11.6793 4.3155 14.6641 7.9974 14.6641C11.6793 14.6641 14.6641 11.6793 14.6641 7.9974C14.6641 4.3155 11.6793 1.33073 7.9974 1.33073Z" fill="#A1A5B7"/>
                                            <path d="M8 6.83073C7.72667 6.83073 7.5 7.0574 7.5 7.33073L7.5 10.6641C7.5 10.9374 7.72667 11.1641 8 11.1641C8.27333 11.1641 8.5 10.9374 8.5 10.6641L8.5 7.33073C8.5 7.0574 8.27333 6.83073 8 6.83073Z" fill="#A1A5B7"/>
                                            <path d="M7.38406 5.59C7.4174 5.67 7.46406 5.74333 7.52406 5.81C7.59073 5.87 7.66406 5.91667 7.74406 5.95C7.90406 6.01667 8.09073 6.01667 8.25073 5.95C8.33073 5.91667 8.40406 5.87 8.47073 5.81C8.53073 5.74333 8.5774 5.67 8.61073 5.59C8.64406 5.51 8.66406 5.42333 8.66406 5.33667C8.66406 5.25 8.64406 5.16333 8.61073 5.08333C8.5774 4.99667 8.53073 4.93 8.47073 4.86333C8.40406 4.80333 8.33073 4.75667 8.25073 4.72333C8.17073 4.69 8.08406 4.67 7.9974 4.67C7.91073 4.67 7.82406 4.69 7.74406 4.72333C7.66406 4.75667 7.59073 4.80333 7.52406 4.86333C7.46406 4.93 7.4174 4.99667 7.38406 5.08333C7.35073 5.16333 7.33073 5.25 7.33073 5.33667C7.33073 5.42333 7.35073 5.51 7.38406 5.59Z" fill="#A1A5B7"/>
                                        </svg>
                                    </a>
                                </th>
                                <th class="text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                     <button
                            class="btn tbr_btn tbr_btn--light-primary sm d-flex flex-center mx-auto  mb-4 gap-4 tbr_add--variant"
                            onclick="addProductVariant()"
                            type="button"
                        >
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3" d="M7.33333 8.66927H4.66667C4.48986 8.66927 4.32029 8.59903 4.19526 8.47401C4.07024 8.34898 4 8.17942 4 8.0026C4 7.82579 4.07024 7.65622 4.19526 7.5312C4.32029 7.40618 4.48986 7.33594 4.66667 7.33594H7.33333V8.66927ZM11.3333 7.33594H8.66667V8.66927H11.3333C11.5101 8.66927 11.6797 8.59903 11.8047 8.47401C11.9298 8.34898 12 8.17942 12 8.0026C12 7.82579 11.9298 7.65622 11.8047 7.5312C11.6797 7.40618 11.5101 7.33594 11.3333 7.33594Z" fill="#DB0916"/>
                                <path opacity="0.3" d="M10.7959 1.33594H5.20927C3.07009 1.33594 1.33594 3.07009 1.33594 5.20927V10.7959C1.33594 12.9351 3.07009 14.6693 5.20927 14.6693H10.7959C12.9351 14.6693 14.6693 12.9351 14.6693 10.7959V5.20927C14.6693 3.07009 12.9351 1.33594 10.7959 1.33594Z" fill="#DB0916"/>
                                <path d="M11.3333 7.33333H8.66667V4.66667C8.66667 4.48986 8.59643 4.32029 8.4714 4.19526C8.34638 4.07024 8.17681 4 8 4C7.82319 4 7.65362 4.07024 7.5286 4.19526C7.40357 4.32029 7.33333 4.48986 7.33333 4.66667V7.33333H4.66667C4.48986 7.33333 4.32029 7.40357 4.19526 7.5286C4.07024 7.65362 4 7.82319 4 8C4 8.17681 4.07024 8.34638 4.19526 8.4714C4.32029 8.59643 4.48986 8.66667 4.66667 8.66667H7.33333V11.3333C7.33333 11.5101 7.40357 11.6797 7.5286 11.8047C7.65362 11.9298 7.82319 12 8 12C8.17681 12 8.34638 11.9298 8.4714 11.8047C8.59643 11.6797 8.66667 11.5101 8.66667 11.3333V8.66667H11.3333C11.5101 8.66667 11.6797 8.59643 11.8047 8.4714C11.9298 8.34638 12 8.17681 12 8C12 7.82319 11.9298 7.65362 11.8047 7.5286C11.6797 7.40357 11.5101 7.33333 11.3333 7.33333Z" fill="#DB0916"/>
                            </svg>
                            <span class="fw-bolder">Tambah</span>
                    </button>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-4">
                <button type="button" onclick="window.location.href = '{{ route('inventories.index') }}'" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                <button anim="ripple" type="submit" class="btn tbr_btn tbr_btn--primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
@push('blockfoot')
    <script>
        const productVariants = @json($productVariants);
    </script>
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
    <script src="{{ asset('assets/js/inventories/stock-out.js') }}"></script>
@endpush
