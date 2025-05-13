@extends('layouts.app')
@section('pageTitle', 'Informasi Sistem')
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection

@section('content')
    <div class="card">
        <div class="card-header flex-column">
            <h3 class="card-title fw-semibold">Informasi Sistem ScrumApps</h3>
            <span class="text-gray-600 text-sm">
                Halaman ini berisi informasi umum terkait sistem, kebijakan, dan panduan penggunaan aplikasi.
            </span>
        </div>
        <div class="card-body ">
            <div class="accordion accordion-icon-toggle" id="kt_accordion_2">
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_1">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Kegunaan Utama Sistem ScrumApps</h3>
                    </div>
                    <div id="kt_accordion_2_item_1" class="fs-6 collapse show ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        ScrumApps dirancang untuk mempermudah pengelolaan proyek secara kolaboratif menggunakan kerangka kerja Scrum. Pengguna dapat membuat, memantau, dan mengelola tugas dalam proyek sesuai dengan role dan hak akses yang dimiliki.
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_2">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Pengguna Sistem</h3>
                    </div>
                    <div id="kt_accordion_2_item_2" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Dalam sistem menggunakan pengguna yang terdiri dari:
                            <br>
                            - Product Owner (Seorang yang yang memberikan detail informasi yang diperoleh dari clien sebagai requirement proyek yang akan dikembangkan)
                            <br>
                            - Tim Developer (Terdiri dari Backend, Frontend, Desaigner UI/UX, dan Sofware Tester)
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_3">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Hak Akses Pengguna</h3>
                    </div>
                    <div id="kt_accordion_2_item_3" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Setiap pengguna memiliki hak akses untuk menjaga keamanan dan keteraturan informasi yang terdiri dar:
                        <br>
                        - Hak Akses Product Owner (Berperan mengeola detail Vision Board dan Backlog dari peoyek dan mengundang Tim Developer untuk memulai proyek)
                        <br>
                        - Hak Akses Tim Developer (Berperan mengerjakan tugas sesuai dengan ketentuan saat perencanaan proyek pada menu Tim Developer dalam kanban)
                    </div>
                </div>



                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_4">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Manajemen Vision Board dan Backlog</h3>
                    </div>
                    <div id="kt_accordion_2_item_4" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        - Fitur Vision Board digunakan untuk mendeskripsikan sistem secara terperinci pada setiap versinya.
                        <br>
                        - Fitur Backlog digunakan untuk mencatat permintaan tugas dari clien dan juga etimasi status prioritas pengembangan.
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_5">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Struktur Proyek dan Sprint</h3>
                    </div>
                    <div id="kt_accordion_2_item_5" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Proyek dalam sistem ini terdiri dari beberapa sprint. Setiap sprint berisi task atau backlog yang harus diselesaikan dalam periode tertentu. Ini membantu pengelolaan waktu dan progres proyek.
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_6">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Notifikasi dan Aktivitas Pengguna</h3>
                    </div>
                    <div id="kt_accordion_2_item_6" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Sistem memberikan notifikasi untuk setiap perubahan status proyek "Done" atau "Late". Riwayat aktivitas juga dapat dilihat oleh anggota proyek terkait.
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_7">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Kontak yang Dapat Dihubungi</h3>
                    </div>
                    <div id="kt_accordion_2_item_7" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Jika mengalami kendala, pengguna dapat menghubungi tim support melalui email:
                            <a href="mailto:support@scrumapps.id?subject=Permintaan%20Bantuan&body=Halo%20tim%20support%2C%20saya%20mengalami%20kendala..." class="text-primary">
                                support@scrumapps.id
                            </a>.
                    </div>
                </div>
                <div class="mb-5">
                    <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_item_8">
                        <span class="accordion-icon">
                            <i class="ki-duotone ki-arrow-right fs-4"><span class="path1"></span><span class="path2"></span></i>
                        </span>
                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Panduan Penggunaan Sistem</h3>
                    </div>
                    <div id="kt_accordion_2_item_8" class="collapse fs-6 ps-10 text-gray-600" data-bs-parent="#kt_accordion_2">
                        Pengguna baru dapat mengakses dokumentasi lengkap atau mengikuti tutorial penggunaan sistem yang tersedia. untuk unduh panduan penggunaan sistem
                            <a href="{{ asset('storage/manual_book.pdf') }}" target="_blank" class="text-primary">klik di sini</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/information/index.js') }}"></script>
    @endpush
@endsection
