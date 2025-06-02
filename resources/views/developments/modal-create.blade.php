<style>
.file-input {
    display: none;
}

.file-label {
    cursor: pointer !important;
    background-color: #f3f6fa !important;
    border: 1px solid #d8d8d8 !important;
    border-radius: 0.35rem !important;
    padding: 0.75rem 1rem;
    color: #c2c6dd;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    transition: background-color 0.2s, color 0.2s;
}
</style>

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
                    action="{{ route('developments.store') }}"
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
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Nama</label>
                            <input type="text" class="tbr_form form-control w-100" name="name" placeholder="Nama Kanban Board" />
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Deskripsi</label>
                            <textarea id="desc_board" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="desc" data-kt-autosize="true" placeholder="Deskripsi Kanban Board"></textarea>
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Lampiran</label>
                            <div class="d-flex align-items-center gap-5">
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="basic-addon3">
                                    <i class="ki-duotone ki-paper-clip fs-2"></i>
                                    </span>
                                    <input type="text" class="tbr_form form-control" id="basic-url"  placeholder="Lampiran Link" name="link" aria-describedby="basic-addon3"/>
                                </div>
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="basic-addon3">
                                        <i class="ki-duotone ki-minus-folder fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <label class="tbr_form form-control file-label" for="file">
                                        <span id="file-name">Lampiran File</span>
                                    </label>
                                    <input type="file" id="file" name="file" class="tbr_form  form-control file-input" aria-describedby="basic-addon3" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button anim="ripple" type="button" onclick="submitAjax({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan Data Kanban</button>
                        </div>
                    </div>
                </form>
                <hr class="tbr_separator my-10">

                {{-- == checklist board == --}}
                <div id="form-checklist" class="form-checkbacklog row flex-col mb-5">
                    <div class="mb-6">
                        <h5>Checklist</h5>
                        <span class="text-gray-600">Isi formulir di bawah untuk menambah checklist backlog setelah menyimpan data backlog di atas.</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">UI/UX</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">BackEnd</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">FrontEnd</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">Quality Assurance</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>

                    {{-- <div id="checklist-wrapper">
                        <div class="checklist-forms"></div>
                        <div class="btn-add-checklist mt-5">
                            <a href="#" class="btn btn-light-danger" onclick="showChecklistForm()">Tambah Checklist</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('file').addEventListener('change', function() {
        const fileName = this.files[0] ? this.files[0].name : "Lampiran File";
        document.getElementById('file-name').textContent = fileName;
    });
</script>
