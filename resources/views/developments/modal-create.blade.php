<div class="modal fade" id="modal_create_boards" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h3 class="modal-title">Tambah Kanban Board</h3>
                </button>
                <i class="ki-duotone ki-cross me-3 fs-1" data-bs-dismiss="modal" style="cursor: pointer;">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="#"
                    method="POST"
                    class="tbr_main_form"
                    enctype="multipart/form-data"
                    data-complete-callback="completeCallback"
                    data-success-callback="successCallback"
                >
                @csrf
                <div class="d-block">
                        {{-- <input type="hidden" name="project_id" value="{{ $project->id }}"> --}}
                        <div class="form-group mb-8">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Nama</label>
                           <input type="text" class="tbr_form form-control w-100" name="name" placeholder="Nama Kanban Board" />
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Deskripsi</label>
                            <textarea id="desc_board" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="desc" data-kt-autosize="true" placeholder="Deskripsi Kanban Board"></textarea>
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Lampiran</label>
                            <textarea id="desc_board" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="desc" data-kt-autosize="true" placeholder="Deskripsi Kanban Board"></textarea>
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
