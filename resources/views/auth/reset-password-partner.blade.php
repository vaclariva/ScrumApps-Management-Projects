@extends('auth.layouts.app')
@section('pageTitle', 'Atur Kata Sandi Baru')
@push('blockhead')
    <style>
        .transitions {
            transition: all .3s ease;
        }
    </style>
@endpush
@section('content')
    <div class="mb-15 d-flex flex-column flex-center">
        <img src="{{ asset('assets/svg/illustrations/logo.svg') }}" width="160" alt="" srcset="">
    </div>
    <form
        action="{{ route('password.partner.resend') }}"
        method="POST"
        class="tbr_main_form d-flex flex-column flex-center mx-auto w-75-responsive"
    >
        @csrf
        <input type="text" name="token" value="{{ $request->route('token') }}" hidden>
        <input type="text" name="is_weak_password" hidden value="0" />

        <h1 class="fw-bolder mb-4">Atur Kata Sandi Baru</h1>
        <p class="mb-10">Atur kata sandi baru untuk akun Anda.</p>

        <div class="form-group w-100 mb-5">
            <input type="text" name="email" value="{{ $request->email }}" id="email" class="tbr_form form-control" placeholder="Alamat Email" readonly>
        </div>

        <div class="form-group w-100 mb-5" id="kt_password_meter_control" data-kt-password-meter="true">
            <div class="position-relative mb-2">
                <input type="password" autocomplete="new-password" name="password" id="password" class="tbr_form form-control" placeholder="Kata Sandi">
                <div class="show-password cursor-pointer">
                    <svg id="open-eye" display="none" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M17.7057 7.7276C15.7807 4.7026 12.9641 2.96094 9.9974 2.96094C8.51406 2.96094 7.0724 3.39427 5.75573 4.2026C4.43906 5.01927 3.25573 6.21094 2.28906 7.7276C1.45573 9.03594 1.45573 11.1609 2.28906 12.4693C4.21406 15.5026 7.03073 17.2359 9.9974 17.2359C11.4807 17.2359 12.9224 16.8026 14.2391 15.9943C15.5557 15.1776 16.7391 13.9859 17.7057 12.4693C18.5391 11.1693 18.5391 9.03594 17.7057 7.7276ZM9.9974 13.4693C8.13073 13.4693 6.63073 11.9609 6.63073 10.1026C6.63073 8.24427 8.13073 6.73594 9.9974 6.73594C11.8641 6.73594 13.3641 8.24427 13.3641 10.1026C13.3641 11.9609 11.8641 13.4693 9.9974 13.4693Z" fill="#A1A5B7"/>
                        <path d="M10 7.71875C8.69167 7.71875 7.625 8.78542 7.625 10.1021C7.625 11.4104 8.69167 12.4771 10 12.4771C11.3083 12.4771 12.3833 11.4104 12.3833 10.1021C12.3833 8.79375 11.3083 7.71875 10 7.71875Z" fill="#A1A5B7"/>
                    </svg>
                    <svg id="close-eye" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M17.7083 7.72708C17.3 7.07708 16.8333 6.49375 16.35 5.96875L13.2083 9.11042C13.3083 9.41875 13.3667 9.75208 13.3667 10.1021C13.3667 11.9688 11.8583 13.4688 10 13.4688C9.65 13.4688 9.31667 13.4104 9.00833 13.3104L6.125 16.1938C7.34167 16.8771 8.65833 17.2354 10 17.2354C11.4833 17.2354 12.925 16.8021 14.2417 15.9938C15.5583 15.1771 16.7417 13.9854 17.7083 12.4688C18.5417 11.1688 18.5417 9.03542 17.7083 7.72708Z" fill="#A1A5B7"/>
                        <path d="M11.6839 8.41875L8.31719 11.7854C7.89219 11.3521 7.61719 10.7521 7.61719 10.1021C7.61719 8.79375 8.68385 7.71875 10.0005 7.71875C10.6505 7.71875 11.2505 7.99375 11.6839 8.41875Z" fill="#A1A5B7"/>
                        <path opacity="0.4" d="M15.2057 4.89427L12.3807 7.71927C11.7724 7.1026 10.9307 6.73594 9.9974 6.73594C8.13073 6.73594 6.63073 8.24427 6.63073 10.1026C6.63073 11.0359 7.00573 11.8776 7.61406 12.4859L4.7974 15.3109H4.78906C3.86406 14.5609 3.01406 13.6026 2.28906 12.4693C1.45573 11.1609 1.45573 9.03594 2.28906 7.7276C3.25573 6.21094 4.43906 5.01927 5.75573 4.2026C7.0724 3.4026 8.51406 2.96094 9.9974 2.96094C11.8557 2.96094 13.6557 3.64427 15.2057 4.89427Z" fill="#A1A5B7"/>
                        <path d="M12.3844 10.1026C12.3844 11.4109 11.3177 12.4859 10.001 12.4859C9.95104 12.4859 9.90937 12.4859 9.85938 12.4693L12.3677 9.96094C12.3844 10.0109 12.3844 10.0526 12.3844 10.1026Z" fill="#A1A5B7"/>
                        <path d="M18.1427 1.96094C17.8927 1.71094 17.4844 1.71094 17.2344 1.96094L1.85938 17.3443C1.60937 17.5943 1.60937 18.0026 1.85938 18.2526C1.98438 18.3693 2.14271 18.4359 2.30938 18.4359C2.47604 18.4359 2.63437 18.3693 2.75937 18.2443L18.1427 2.86094C18.401 2.61094 18.401 2.21094 18.1427 1.96094Z" fill="#A1A5B7"/>
                    </svg>
                </div>
            </div>
            <div class="mb-2" data-kt-password-meter-control="highlight">
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-danger rounded h-5px me-2 transitions" id="progress-1"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2 transitions"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2 transitions"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px transitions"></div>
                </div>
            </div>
            <p class="mb-0 text-muted" id="text-info-length">
                Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.
            </p>
        </div>
        <div class="form-group w-100 mb-5">
            <div class="position-relative mb-2">
                <input type="password" autocomplete="false" name="password_confirmation" id="password_confirmation" class="tbr_form form-control" placeholder="Konfirmasi Kata Sandi">
                <div class="show-password cursor-pointer">
                    <svg id="open-eye" display="none" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M17.7057 7.7276C15.7807 4.7026 12.9641 2.96094 9.9974 2.96094C8.51406 2.96094 7.0724 3.39427 5.75573 4.2026C4.43906 5.01927 3.25573 6.21094 2.28906 7.7276C1.45573 9.03594 1.45573 11.1609 2.28906 12.4693C4.21406 15.5026 7.03073 17.2359 9.9974 17.2359C11.4807 17.2359 12.9224 16.8026 14.2391 15.9943C15.5557 15.1776 16.7391 13.9859 17.7057 12.4693C18.5391 11.1693 18.5391 9.03594 17.7057 7.7276ZM9.9974 13.4693C8.13073 13.4693 6.63073 11.9609 6.63073 10.1026C6.63073 8.24427 8.13073 6.73594 9.9974 6.73594C11.8641 6.73594 13.3641 8.24427 13.3641 10.1026C13.3641 11.9609 11.8641 13.4693 9.9974 13.4693Z" fill="#A1A5B7"/>
                        <path d="M10 7.71875C8.69167 7.71875 7.625 8.78542 7.625 10.1021C7.625 11.4104 8.69167 12.4771 10 12.4771C11.3083 12.4771 12.3833 11.4104 12.3833 10.1021C12.3833 8.79375 11.3083 7.71875 10 7.71875Z" fill="#A1A5B7"/>
                    </svg>
                    <svg id="close-eye" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M17.7083 7.72708C17.3 7.07708 16.8333 6.49375 16.35 5.96875L13.2083 9.11042C13.3083 9.41875 13.3667 9.75208 13.3667 10.1021C13.3667 11.9688 11.8583 13.4688 10 13.4688C9.65 13.4688 9.31667 13.4104 9.00833 13.3104L6.125 16.1938C7.34167 16.8771 8.65833 17.2354 10 17.2354C11.4833 17.2354 12.925 16.8021 14.2417 15.9938C15.5583 15.1771 16.7417 13.9854 17.7083 12.4688C18.5417 11.1688 18.5417 9.03542 17.7083 7.72708Z" fill="#A1A5B7"/>
                        <path d="M11.6839 8.41875L8.31719 11.7854C7.89219 11.3521 7.61719 10.7521 7.61719 10.1021C7.61719 8.79375 8.68385 7.71875 10.0005 7.71875C10.6505 7.71875 11.2505 7.99375 11.6839 8.41875Z" fill="#A1A5B7"/>
                        <path opacity="0.4" d="M15.2057 4.89427L12.3807 7.71927C11.7724 7.1026 10.9307 6.73594 9.9974 6.73594C8.13073 6.73594 6.63073 8.24427 6.63073 10.1026C6.63073 11.0359 7.00573 11.8776 7.61406 12.4859L4.7974 15.3109H4.78906C3.86406 14.5609 3.01406 13.6026 2.28906 12.4693C1.45573 11.1609 1.45573 9.03594 2.28906 7.7276C3.25573 6.21094 4.43906 5.01927 5.75573 4.2026C7.0724 3.4026 8.51406 2.96094 9.9974 2.96094C11.8557 2.96094 13.6557 3.64427 15.2057 4.89427Z" fill="#A1A5B7"/>
                        <path d="M12.3844 10.1026C12.3844 11.4109 11.3177 12.4859 10.001 12.4859C9.95104 12.4859 9.90937 12.4859 9.85938 12.4693L12.3677 9.96094C12.3844 10.0109 12.3844 10.0526 12.3844 10.1026Z" fill="#A1A5B7"/>
                        <path d="M18.1427 1.96094C17.8927 1.71094 17.4844 1.71094 17.2344 1.96094L1.85938 17.3443C1.60937 17.5943 1.60937 18.0026 1.85938 18.2526C1.98438 18.3693 2.14271 18.4359 2.30938 18.4359C2.47604 18.4359 2.63437 18.3693 2.75937 18.2443L18.1427 2.86094C18.401 2.61094 18.401 2.21094 18.1427 1.96094Z" fill="#A1A5B7"/>
                    </svg>
                </div>
            </div>
        </div>
        <label class="form-check form-check-inline d-flex w-100 mb-5 d-none" id="ensure-weak-password">
                <input
                    class="form-check-input"
                    type="checkbox"
                    name="checklist_weak_password"
                    value="1"
                />
                <span class="fw-medium ms-3">
                    Gunakan kata sandi meskipun lemah
                </span>
        </label>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100 mb-15" type="submit">Kirim</button>
    </form>

    @push('blockfoot')
        <script src="{{ asset('assets/js/auth/reset-password.js') }}"></script>
    @endpush
@endsection
