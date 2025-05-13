<style>
    .ck-editor__editable:focus {
        border-color: #dc2626 !important;
        box-shadow: 0 0 0 0.15rem rgba(220, 38, 38, 0.08) !important;
    }
</style>

<div class="modal fade" id="modal_create_vision_boards" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Vision Board</h3>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="{{ route('vision-boards.store') }}"
                    method="POST"
                    class="tbr_main_form"
                    enctype="multipart/form-data"
                    data-complete-callback="completeCallback"
                    data-success-callback="successCallback"
                >
                @csrf
                    <div class="d-block">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Nama</label>
                            <input type="text" class="tbr_form form-control w-100" name="name" placeholder="Masukkan Versi Pengembangan Proyek" />
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Vision <span class="text-gray-600"> (Visi) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="vision" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="vision_editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Target Group <span class="text-gray-600"> (Target Sasaran) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="target_group" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="target_group_editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Needs <span class="text-gray-600"> (Kebutuhan) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="needs" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="needs_editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Product <span class="text-gray-600"> (Produk) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="products" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="products_editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Business Goals <span class="text-gray-600"> (Tujuan Bisnis) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="business_goals" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="goals_editor"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Competitors <span class="text-gray-600"> (Pesaing) </span></label>
                            <div class="py-0" data-bs-theme="light">
                                <textarea name="competitors" class="tbr_form form-control focus:border-red-600 focus:ring-0 ckeditor-field" id="competitors_editor"></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button anim="ripple" type="button" class="btn tbr_btn tbr_btn--light me-3" data-bs-dismiss="modal">Batal</button>
                            <button anim="ripple" type="button" onclick="submitAjax({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
