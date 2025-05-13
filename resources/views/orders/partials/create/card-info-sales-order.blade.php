<div class="accordion accordion-icon-toggle tbr_accordion" id="accodion-parent-sales-order">
    <div class="card w-100">
        <div id="sales-order-collapse" class="accordion-header d-flex" data-bs-toggle="collapse" data-bs-target="#accordion-sales-order" aria-expanded="true">
            <div class="card-header flex w-100">
                <div class="d-flex flex-column flex-root">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center mb-2 mb-lg-0 gap-2 gap-lg-3">
                        <h5 class="mb-0">Informasi Sales Order</h5>
                        <div>
                            <span class="tbr_alert tbr_alert--primary xs">Model: B2B</span>
                            <span class="tbr_alert tbr_alert--primary xs">Pelaksana: {{ auth()->user()->name ?? '-' }}</span>
                        </div>
                    </div>
                    <span id="header-info-unexpanded" class="text-gray-600">Isi formulir dibawah untuk menambahkan informasi sales order.</span>
                    <div id="header-info-expanded" class="d-none align-items-center text-gray-600">
                        <span>{{ $order->so_number ?? '-' }}</span>
                        <span class="mx-2">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#A1A5B7"/>
                            </svg>
                        </span>
                        <span class="date--text">-</span>
                        <span class="mx-2">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#A1A5B7"/>
                            </svg>
                        </span>
                        <span class="warehouse_name--text">-</span>
                        <span class="mx-2">
                            <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#A1A5B7"/>
                            </svg>
                        </span>
                        <span class="partner_name--text">-</span>
                    </div>
                </div>
                <span class="accordion-icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.90848 14.3705C9.79881 14.3711 9.69009 14.3501 9.58856 14.3086C9.48702 14.2671 9.39468 14.206 9.31681 14.1288L4.31681 9.12879C4.2387 9.05132 4.17671 8.95915 4.1344 8.8576C4.09209 8.75605 4.07031 8.64713 4.07031 8.53712C4.07031 8.42711 4.09209 8.31819 4.1344 8.21664C4.17671 8.11509 4.2387 8.02292 4.31681 7.94545C4.47295 7.79024 4.68416 7.70312 4.90431 7.70313C5.12447 7.70312 5.33568 7.79024 5.49181 7.94545L9.90848 12.3621L14.3168 7.94545C14.4729 7.79024 14.6842 7.70313 14.9043 7.70313C15.1245 7.70313 15.3357 7.79024 15.4918 7.94545C15.5699 8.02292 15.6319 8.11509 15.6742 8.21664C15.7165 8.31819 15.7383 8.42711 15.7383 8.53712C15.7383 8.64713 15.7165 8.75605 15.6742 8.8576C15.6319 8.95915 15.5699 9.05132 15.4918 9.12879L10.4918 14.1288C10.3366 14.2827 10.1271 14.3695 9.90848 14.3705Z" fill="#A1A5B7"/>
                    </svg>
                </span>
            </div>
        </div>
        <div class="card-body collapse show body-accordion" id="accordion-sales-order">
            <div>
                <div id="parent-form-input">
                    <div class="row form-group mb-8">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <label for="order_number" class="h6 tbr_font--weight-bold mt-4">Nomor Pesanan</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="tbr_form form-control" name="order_number" id="order_number" value="{{ $order->so_number ?? '-' }}" disabled/>
                        </div>
                    </div>
                    <div class="row form-group mb-8">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <label for="date" class="h6 tbr_font--weight-bold mt-4">Tanggal</label>
                            <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
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
                            <label for="warehouse_id" class="h6 tbr_font--weight-bold mt-4">Lokasi</label>
                            <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                        </div>
                        <div class="col-lg-8">
                            <select id="warehouse_id" name="warehouse_id" class="form-select tbr_form  form-select-solid" data-control="select2">
                                <option value="" selected disabled>Pilih Lokasi</option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" data-warehouse="{{ json_encode($warehouse) }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group mb-8">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <label for="partner_id" class="h6 tbr_font--weight-bold mt-4">Pemesan</label>
                            <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex gap-4 mb-1">
                                <select id='partner_id' name="partner_id" class="form-select tbr_form  form-select-solid flex-root" data-control="select2" data-shipping-address="{{ $orderDelivery->shipping_address ?? '' }}" disabled>
                                    <option value="" selected disabled>Pilih Pemesan</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}" data-partner="{{ json_encode($partner) }}">{{ $partner->name }} - {{ $partner->regency ?? '' }}</option>
                                    @endforeach
                                </select>
                                <button
                                    class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary d-none"
                                    id="button-info-partner"
                                >
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M21.0026 3.5H7.0026C4.42427 3.5 2.33594 5.57667 2.33594 8.13167V19.8683C2.33594 22.4233 4.42427 24.5 7.0026 24.5H21.0026C23.5809 24.5 25.6693 22.4233 25.6693 19.8683V8.13167C25.6693 5.57667 23.5809 3.5 21.0026 3.5Z" fill="#DB0916"/>
                                        <path d="M22.1693 10.207H16.3359C15.8576 10.207 15.4609 9.81036 15.4609 9.33203C15.4609 8.8537 15.8576 8.45703 16.3359 8.45703H22.1693C22.6476 8.45703 23.0443 8.8537 23.0443 9.33203C23.0443 9.81036 22.6476 10.207 22.1693 10.207Z" fill="#DB0916"/>
                                        <path d="M22.1667 14.875H17.5C17.0217 14.875 16.625 14.4783 16.625 14C16.625 13.5217 17.0217 13.125 17.5 13.125H22.1667C22.645 13.125 23.0417 13.5217 23.0417 14C23.0417 14.4783 22.645 14.875 22.1667 14.875Z" fill="#DB0916"/>
                                        <path d="M22.1693 19.543H19.8359C19.3576 19.543 18.9609 19.1463 18.9609 18.668C18.9609 18.1896 19.3576 17.793 19.8359 17.793H22.1693C22.6476 17.793 23.0443 18.1896 23.0443 18.668C23.0443 19.1463 22.6476 19.543 22.1693 19.543Z" fill="#DB0916"/>
                                        <path d="M9.92156 13.7533C11.41 13.7533 12.6166 12.5467 12.6166 11.0583C12.6166 9.56987 11.41 8.36328 9.92156 8.36328C8.43316 8.36328 7.22656 9.56987 7.22656 11.0583C7.22656 12.5467 8.43316 13.7533 9.92156 13.7533Z" fill="#DB0916"/>
                                        <path d="M10.8517 15.2938C10.2334 15.2354 9.59174 15.2354 8.97341 15.2938C7.01341 15.4804 5.43841 17.0321 5.25174 18.9921C5.24007 19.1554 5.28674 19.3188 5.40341 19.4354C5.52007 19.5521 5.67174 19.6338 5.83507 19.6338H14.0017C14.1651 19.6338 14.3284 19.5638 14.4334 19.4471C14.5384 19.3304 14.5967 19.1671 14.5851 19.0038C14.3867 17.0321 12.8234 15.4804 10.8517 15.2938Z" fill="#DB0916"/>
                                    </svg>
                                </button>
                            </div>
                            <div id="parent-remaining-credit" class="d-flex flex-column flex-lg-row align-items-lg-center tbr_text--icon d-none">
                                <div>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M12.0241 9.03463C11.7441 9.30796 11.5841 9.7013 11.6241 10.1213C11.6841 10.8413 12.3441 11.368 13.0641 11.368H14.3307V12.1613C14.3307 13.5413 13.2041 14.668 11.8241 14.668H4.17073C2.79073 14.668 1.66406 13.5413 1.66406 12.1613V7.67464C1.66406 6.29464 2.79073 5.16797 4.17073 5.16797H11.8241C13.2041 5.16797 14.3307 6.29464 14.3307 7.67464V8.63464H12.9841C12.6107 8.63464 12.2707 8.78129 12.0241 9.03463Z" fill="#A1A5B7"/>
                                    <path d="M9.8974 2.63439V5.16772H4.17073C2.79073 5.16772 1.66406 6.29439 1.66406 7.67439V5.22774C1.66406 4.4344 2.15073 3.72771 2.89073 3.44771L8.18406 1.44771C9.01073 1.14104 9.8974 1.74773 9.8974 2.63439Z" fill="#A1A5B7"/>
                                    <path d="M15.0366 9.31278V10.6862C15.0366 11.0528 14.7433 11.3528 14.3699 11.3661H13.0633C12.3433 11.3661 11.6833 10.8395 11.6233 10.1195C11.5833 9.69947 11.7433 9.30613 12.0233 9.0328C12.2699 8.77946 12.6099 8.63281 12.9833 8.63281H14.3699C14.7433 8.64615 15.0366 8.94612 15.0366 9.31278Z" fill="#A1A5B7"/>
                                    <path d="M9.33073 8.5H4.66406C4.39073 8.5 4.16406 8.27333 4.16406 8C4.16406 7.72667 4.39073 7.5 4.66406 7.5H9.33073C9.60406 7.5 9.83073 7.72667 9.83073 8C9.83073 8.27333 9.60406 8.5 9.33073 8.5Z" fill="#A1A5B7"/>
                                    </svg>
                                    <span class="ms-1">Sisa kredit: <span id="remaining-credit">0</span></span>
                                </div>
                                <div>
                                    <span class="mx-2">
                                        <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="2" cy="2" r="2" fill="#A1A5B7"/>
                                        </svg>
                                    </span>
                                    <span>Tekan tombol disamping untuk melihat detail pemesan.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="parent-info-delivery" class="d-none">
                    <hr class="tbr_separator my-9">
                    <div class="row align-items-stretch g-4">
                        <div class="col-lg-5">
                            <div class="card tbr_inside--card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0">Asal Pengiriman (<span class="warehouse_name--text">-</span>)</h6>
                                </div>
                                <div class="card-body text-gray-600 d-flex align-items-center">
                                    Coming soon
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 d-flex align-items-center justify-content-center">
                            <img class="img-fluid" id="illustration-delivery" src="{{ asset('assets/svg/illustrations/delivery.svg') }}" alt="" srcset="">
                        </div>
                        <div class="col-lg-5">
                            <div class="card tbr_inside--card h-100">
                                <div class="card-header p-10px gap-4 d-flex align-items-center">
                                    <h6 class="mb-0 flex-root text-truncate">Tujuan Pengiriman (<span class="partner_name--text">-</span>)</h6>
                                    <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-warning xs ajax-disable" onclick="editDestination({el: this})">
                                        <span id="edit-destination" >
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4" d="M10.3226 2H5.01594C2.71594 2 1.33594 3.37333 1.33594 5.68V10.98C1.33594 13.2933 2.71594 14.6667 5.01594 14.6667H10.3159C12.6226 14.6667 13.9959 13.2933 13.9959 10.9867V5.68C14.0026 3.37333 12.6226 2 10.3226 2Z" fill="#F6B100"/>
                                                <path d="M14.013 1.98815C12.8197 0.788153 11.653 0.761486 10.4263 1.98815L9.67299 2.73482C9.60632 2.80149 9.58632 2.89482 9.61299 2.98149C10.0797 4.61482 11.3863 5.92149 13.0197 6.38815C13.0397 6.39482 13.073 6.39482 13.093 6.39482C13.1597 6.39482 13.2263 6.36815 13.273 6.32149L14.013 5.57482C14.6197 4.96815 14.9197 4.38815 14.9197 3.79482C14.9197 3.19482 14.6197 2.60149 14.013 1.98815Z" fill="#F6B100"/>
                                                <path d="M11.91 6.94526C11.73 6.85859 11.5567 6.77193 11.3967 6.67193C11.2633 6.59193 11.13 6.50526 11.0033 6.41193C10.8967 6.34526 10.7767 6.24526 10.6567 6.14526C10.6433 6.13859 10.6033 6.10526 10.55 6.05193C10.3433 5.88526 10.1233 5.65859 9.91666 5.41193C9.90332 5.39859 9.86332 5.35859 9.82999 5.29859C9.76332 5.22526 9.66332 5.09859 9.57666 4.95859C9.50332 4.86526 9.41666 4.73193 9.33666 4.59193C9.23666 4.42526 9.14999 4.25859 9.06999 4.08526C8.98332 3.89859 8.91666 3.72526 8.85666 3.55859L5.26999 7.14526C5.03666 7.37859 4.80999 7.81859 4.76332 8.14526L4.47666 10.1319C4.41666 10.5519 4.52999 10.9453 4.78999 11.2053C5.00999 11.4253 5.30999 11.5386 5.64332 11.5386C5.71666 11.5386 5.78999 11.5319 5.86332 11.5253L7.84332 11.2453C8.16999 11.1986 8.60999 10.9786 8.84332 10.7386L12.43 7.15193C12.2633 7.09859 12.0967 7.02526 11.91 6.94526Z" fill="#F6B100"/>
                                            </svg>
                                        </span>
                                        <span id="done-edit-destination" class="d-none">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.445 3.95079C14.744 4.24975 14.744 4.73447 14.445 5.03344L7.4275 12.051C7.12854 12.3499 6.64382 12.3499 6.34485 12.051L1.56016 7.26629C1.2612 6.96733 1.2612 6.48261 1.56016 6.18364C1.85913 5.88468 2.34385 5.88468 2.64281 6.18364L6.88618 10.427L13.3624 3.95079C13.6614 3.65182 14.1461 3.65182 14.445 3.95079Z" fill="#F6B100"/>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="card-body text-gray-600">
                                    <span id="address-delivery" class="d-flex align-items-center">-</span>
                                    <textarea name="shipping_address" id="parnert-address-input" rows="3" class="tbr_form form-control rounded-top-0 d-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
