<div class="card">
    <div>
        <div class="card-header d-flex">
            <div class="flex-column">
                <h5>Item Sales Order</h5>
                <span class="text-gray-600">Isi formulir dibawah untuk menambahkan item sales order.</span>
            </div>
            <div class="w-100 w-lg-25 mt-4 mt-lg-0 filter">
                <select name="type" id="type" class="tbr_form form-select form-select-solid " data-dropdown-parent=".filter" data-control="select2" data-placeholder="Pilih Jenis" data-minimum-results-for-search="Infinity">
                    <option></option>
                    <option value="Popular" {{ $order->product_order_type == "Popular" || $order->product_order_type == null ? "selected" : ""}}>Populer</option>
                    <option value="Pengembangan" {{ $order->product_order_type == "Pengembangan" ? "selected" : ""}}>Pengembangan</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between gap-2 w-100">
            <span class="d-flex align-items-center justify-content-between tbr_alert tbr_alert--danger border-dashed--tbr-primary p-5 w-100 xs">
                <div class="d-flex align-items-center justify-content-start">
                <a anim="ripple" type="button" class="btn tbr_btn tbr_btn--icon tbr_btn--danger sm me-2">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M31.1693 11.0629V22.9204C31.1693 28.077 28.0951 31.1512 22.9384 31.1512H11.0668C5.9101 31.1654 2.83594 28.0912 2.83594 22.9345V11.0629C2.83594 5.9062 5.9101 2.83203 11.0668 2.83203H22.9243C28.0951 2.83203 31.1693 5.9062 31.1693 11.0629Z" fill="#DB0916"/>
                        <path d="M17.0026 25.8529C14.4668 25.8529 12.4834 24.592 11.1376 23.3454V24.3512C11.1376 24.932 10.6559 25.4137 10.0751 25.4137C9.49427 25.4137 9.0126 24.932 9.0126 24.3512V20.4554C9.0126 19.8745 9.49427 19.3929 10.0751 19.3929H13.5884C14.1693 19.3929 14.6509 19.8745 14.6509 20.4554C14.6509 21.0362 14.1693 21.5179 13.5884 21.5179H12.3134C13.3618 22.5662 14.9909 23.7279 17.0026 23.7279C20.7143 23.7279 23.7318 20.7104 23.7318 16.9987C23.7318 16.4179 24.2134 15.9362 24.7943 15.9362C25.3751 15.9362 25.8568 16.4179 25.8568 16.9987C25.8568 21.8862 21.8901 25.8529 17.0026 25.8529ZM9.21094 18.0612C8.6301 18.0612 8.14844 17.5795 8.14844 16.9987C8.14844 12.1112 12.1151 8.14453 17.0026 8.14453C20.0484 8.14453 22.2868 9.46203 23.7318 10.7229V9.6462C23.7318 9.06536 24.2134 8.5837 24.7943 8.5837C25.3751 8.5837 25.8568 9.06536 25.8568 9.6462V13.5279C25.8568 13.5704 25.8568 13.6129 25.8568 13.6412C25.8426 13.797 25.8001 13.9387 25.7293 14.0662C25.6584 14.1937 25.5593 14.307 25.4318 14.4062C25.3326 14.477 25.2193 14.5337 25.0918 14.5762C24.9926 14.6045 24.8934 14.6187 24.7943 14.6187H21.3518C20.7709 14.6187 20.2893 14.137 20.2893 13.5562C20.2893 12.9754 20.7709 12.4937 21.3518 12.4937H22.5276C21.3943 11.4454 19.5668 10.2837 17.0309 10.2837C13.3193 10.2837 10.3018 13.3012 10.3018 17.0129C10.2734 17.5795 9.79177 18.0612 9.21094 18.0612Z" fill="#DB0916"/>
                    </svg>
                </a>
                <span class="text-gray-600 fw-semibold fs-7">
                Terdapat perubahan quantity pada produk yang akan dibeli. Lakukan konfirmasi perubahan sebelum diproses agar tercatat pada riwayat stok.
                </span>
            </div>
                <a href="#" target="_blank" anim="ripple" class="btn tbr_btn tbr_btn--primary d-flex flex-center gap-2 mx-7 md">
                    <span>Konfirmasi Perubahan</span>
                </a>
            </span>
        </div>
        <div class="table-responsive mt-8">
            <table class="table align-middle" id="table-product-ordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div class="d-flex flex-column gap-2 flex-center tbr_empty--product d-none">
                <img src="{{ asset('assets/svg/illustrations/empty-variant.svg') }}" alt="" srcset="">
                <h5 class="mb-0">Produk Kosong</h5>
                <span class="text-gray-600 mb-5">Silakan mulai menambahkan produk sekarang.</span>
            </div>
            <button
                class="btn tbr_btn tbr_btn--light-primary sm d-flex flex-center mx-auto gap-4 tbr_add--product d-none"
                onclick="showModalProduct()"
                disabled>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M7.33333 8.66927H4.66667C4.48986 8.66927 4.32029 8.59903 4.19526 8.47401C4.07024 8.34898 4 8.17942 4 8.0026C4 7.82579 4.07024 7.65622 4.19526 7.5312C4.32029 7.40618 4.48986 7.33594 4.66667 7.33594H7.33333V8.66927ZM11.3333 7.33594H8.66667V8.66927H11.3333C11.5101 8.66927 11.6797 8.59903 11.8047 8.47401C11.9298 8.34898 12 8.17942 12 8.0026C12 7.82579 11.9298 7.65622 11.8047 7.5312C11.6797 7.40618 11.5101 7.33594 11.3333 7.33594Z" fill="#DB0916" />
                    <path opacity="0.3" d="M10.7959 1.33594H5.20927C3.07009 1.33594 1.33594 3.07009 1.33594 5.20927V10.7959C1.33594 12.9351 3.07009 14.6693 5.20927 14.6693H10.7959C12.9351 14.6693 14.6693 12.9351 14.6693 10.7959V5.20927C14.6693 3.07009 12.9351 1.33594 10.7959 1.33594Z" fill="#DB0916" />
                    <path d="M11.3333 7.33333H8.66667V4.66667C8.66667 4.48986 8.59643 4.32029 8.4714 4.19526C8.34638 4.07024 8.17681 4 8 4C7.82319 4 7.65362 4.07024 7.5286 4.19526C7.40357 4.32029 7.33333 4.48986 7.33333 4.66667V7.33333H4.66667C4.48986 7.33333 4.32029 7.40357 4.19526 7.5286C4.07024 7.65362 4 7.82319 4 8C4 8.17681 4.07024 8.34638 4.19526 8.4714C4.32029 8.59643 4.48986 8.66667 4.66667 8.66667H7.33333V11.3333C7.33333 11.5101 7.40357 11.6797 7.5286 11.8047C7.65362 11.9298 7.82319 12 8 12C8.17681 12 8.34638 11.9298 8.4714 11.8047C8.59643 11.6797 8.66667 11.5101 8.66667 11.3333V8.66667H11.3333C11.5101 8.66667 11.6797 8.59643 11.8047 8.4714C11.9298 8.34638 12 8.17681 12 8C12 7.82319 11.9298 7.65362 11.8047 7.5286C11.6797 7.40357 11.5101 7.33333 11.3333 7.33333Z" fill="#DB0916" />
                </svg>
                <span class="fw-bolder">Tambah Produk</span>
            </button>
            <div class="d-flex flex-center mb-5" id="loader-ordered">
                <span class="spinner-border tbr_text--primary" role="status"></span>
            </div>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-lg-6">
                <div class="card tbr_inside--card h-100">
                    <div class="card-header">
                        <h6 class="mb-0">Catatan</h6>
                    </div>
                    <div class="card-body text-gray-600 p-0">
                        <textarea name="note" rows="3" placeholder="Tulis catatan..." class="tbr_form form-control bg-transparent rounded-top-0 h-100">{{ $order->note ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card tbr_inside--card h-100">
                    <div class="card-header">
                        <h6 class="mb-0">Ringkasan Sales Order</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column flex-lg-row gap-2 mb-5">
                            <div class="flex-root d-flex align-items-center">
                                <label class="text-gray-500">Subtotal (<span id="total-qty">0</span> Item)</label>
                            </div>
                            <span class="text-gray-800" id="total-price-row">Rp 0</span>
                        </div>
                        <div class="d-flex flex-column flex-lg-row gap-2 mb-5">
                            <div class="flex-root d-flex align-items-center">
                                <label class="text-gray-500 text-nowrap">Diskon Khusus</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-lg-end gap-2">
                                <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-warning xs" onclick="editExtraDiscount({el: this})" id="edit-discount-button" data-url="{{ route('orders.updatePartial', $order->id) }}">
                                    <span id="edit-extra-discount">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M10.3226 2H5.01594C2.71594 2 1.33594 3.37333 1.33594 5.68V10.98C1.33594 13.2933 2.71594 14.6667 5.01594 14.6667H10.3159C12.6226 14.6667 13.9959 13.2933 13.9959 10.9867V5.68C14.0026 3.37333 12.6226 2 10.3226 2Z" fill="#F6B100" />
                                            <path d="M14.013 1.98815C12.8197 0.788153 11.653 0.761486 10.4263 1.98815L9.67299 2.73482C9.60632 2.80149 9.58632 2.89482 9.61299 2.98149C10.0797 4.61482 11.3863 5.92149 13.0197 6.38815C13.0397 6.39482 13.073 6.39482 13.093 6.39482C13.1597 6.39482 13.2263 6.36815 13.273 6.32149L14.013 5.57482C14.6197 4.96815 14.9197 4.38815 14.9197 3.79482C14.9197 3.19482 14.6197 2.60149 14.013 1.98815Z" fill="#F6B100" />
                                            <path d="M11.91 6.94526C11.73 6.85859 11.5567 6.77193 11.3967 6.67193C11.2633 6.59193 11.13 6.50526 11.0033 6.41193C10.8967 6.34526 10.7767 6.24526 10.6567 6.14526C10.6433 6.13859 10.6033 6.10526 10.55 6.05193C10.3433 5.88526 10.1233 5.65859 9.91666 5.41193C9.90332 5.39859 9.86332 5.35859 9.82999 5.29859C9.76332 5.22526 9.66332 5.09859 9.57666 4.95859C9.50332 4.86526 9.41666 4.73193 9.33666 4.59193C9.23666 4.42526 9.14999 4.25859 9.06999 4.08526C8.98332 3.89859 8.91666 3.72526 8.85666 3.55859L5.26999 7.14526C5.03666 7.37859 4.80999 7.81859 4.76332 8.14526L4.47666 10.1319C4.41666 10.5519 4.52999 10.9453 4.78999 11.2053C5.00999 11.4253 5.30999 11.5386 5.64332 11.5386C5.71666 11.5386 5.78999 11.5319 5.86332 11.5253L7.84332 11.2453C8.16999 11.1986 8.60999 10.9786 8.84332 10.7386L12.43 7.15193C12.2633 7.09859 12.0967 7.02526 11.91 6.94526Z" fill="#F6B100" />
                                        </svg>
                                    </span>
                                    <span id="done-edit-extra-discount" class="d-none">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.445 3.95079C14.744 4.24975 14.744 4.73447 14.445 5.03344L7.4275 12.051C7.12854 12.3499 6.64382 12.3499 6.34485 12.051L1.56016 7.26629C1.2612 6.96733 1.2612 6.48261 1.56016 6.18364C1.85913 5.88468 2.34385 5.88468 2.64281 6.18364L6.88618 10.427L13.3624 3.95079C13.6614 3.65182 14.1461 3.65182 14.445 3.95079Z" fill="#F6B100" />
                                        </svg>
                                    </span>
                                </button>
                                <div class="input-group sm d-none" id="extra-discount-input">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="text"
                                        class="tbr_form sm form-control autonumeric"
                                        min="0"
                                        name="extra_discount"
                                        data-ajax-disabled="true"
                                        autocomplete="off"
                                        value="{{ $order->extra_discount ?? 0 }}"
                                    />
                                </div>
                                <span class="text-gray-800" id="extra-discount-text">{{ rupiah($order->extra_discount ?? 0) }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-lg-row gap-2">
                            <div class="flex-root d-flex align-items-center">
                                <label class="text-gray-500 text-nowrap">Ongkos Kirim</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-lg-end gap-2">
                                <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-warning xs" onclick="editShippingCost({el: this})" id="edit-shipping-cost-button" data-url="{{ route('orders.updatePartial', $order->id) }}">
                                    <span id="edit-shipping-cost">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M10.3226 2H5.01594C2.71594 2 1.33594 3.37333 1.33594 5.68V10.98C1.33594 13.2933 2.71594 14.6667 5.01594 14.6667H10.3159C12.6226 14.6667 13.9959 13.2933 13.9959 10.9867V5.68C14.0026 3.37333 12.6226 2 10.3226 2Z" fill="#F6B100" />
                                            <path d="M14.013 1.98815C12.8197 0.788153 11.653 0.761486 10.4263 1.98815L9.67299 2.73482C9.60632 2.80149 9.58632 2.89482 9.61299 2.98149C10.0797 4.61482 11.3863 5.92149 13.0197 6.38815C13.0397 6.39482 13.073 6.39482 13.093 6.39482C13.1597 6.39482 13.2263 6.36815 13.273 6.32149L14.013 5.57482C14.6197 4.96815 14.9197 4.38815 14.9197 3.79482C14.9197 3.19482 14.6197 2.60149 14.013 1.98815Z" fill="#F6B100" />
                                            <path d="M11.91 6.94526C11.73 6.85859 11.5567 6.77193 11.3967 6.67193C11.2633 6.59193 11.13 6.50526 11.0033 6.41193C10.8967 6.34526 10.7767 6.24526 10.6567 6.14526C10.6433 6.13859 10.6033 6.10526 10.55 6.05193C10.3433 5.88526 10.1233 5.65859 9.91666 5.41193C9.90332 5.39859 9.86332 5.35859 9.82999 5.29859C9.76332 5.22526 9.66332 5.09859 9.57666 4.95859C9.50332 4.86526 9.41666 4.73193 9.33666 4.59193C9.23666 4.42526 9.14999 4.25859 9.06999 4.08526C8.98332 3.89859 8.91666 3.72526 8.85666 3.55859L5.26999 7.14526C5.03666 7.37859 4.80999 7.81859 4.76332 8.14526L4.47666 10.1319C4.41666 10.5519 4.52999 10.9453 4.78999 11.2053C5.00999 11.4253 5.30999 11.5386 5.64332 11.5386C5.71666 11.5386 5.78999 11.5319 5.86332 11.5253L7.84332 11.2453C8.16999 11.1986 8.60999 10.9786 8.84332 10.7386L12.43 7.15193C12.2633 7.09859 12.0967 7.02526 11.91 6.94526Z" fill="#F6B100" />
                                        </svg>
                                    </span>
                                    <span id="done-edit-shipping-cost" class="d-none">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.445 3.95079C14.744 4.24975 14.744 4.73447 14.445 5.03344L7.4275 12.051C7.12854 12.3499 6.64382 12.3499 6.34485 12.051L1.56016 7.26629C1.2612 6.96733 1.2612 6.48261 1.56016 6.18364C1.85913 5.88468 2.34385 5.88468 2.64281 6.18364L6.88618 10.427L13.3624 3.95079C13.6614 3.65182 14.1461 3.65182 14.445 3.95079Z" fill="#F6B100" />
                                        </svg>
                                    </span>
                                </button>
                                <div class="input-group sm d-none" id="shipping-cost-input">
                                    <span class="input-group-text">Rp</span>
                                    <input
                                        type="text"
                                        class="tbr_form sm form-control autonumeric"
                                        min="0"
                                        name="shipping_cost"
                                        data-ajax-disabled="true"
                                        autocomplete="off"
                                        value="{{ $order->shipping_cost ?? 0 }}"
                                    />
                                </div>
                                <span class="text-gray-800" id="shipping-cost-text">{{ rupiah($order->shipping_cost ?? 0) }}</span>
                            </div>
                        </div>
                        <hr class="tbr_separator" />
                        <div class="d-flex flex-column flex-lg-row gap-2 mb-5">
                            <div class="flex-root d-flex align-items-center">
                                <label class="text-gray-800 fw-bold fs-5">Grand Total</label>
                            </div>
                            <span class="text-gray-800 text-lg fw-bold fs-5" id="grand-total">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
