<div class="modal fade" id="modal_edit_boards" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center justify-content-between">
                <h3 class="modal-title">Edit Kanban Board</h3>
                <div class="d-flex align-items-center gap-4">
                        <a
                            id="btn_delete_in_edit_modal"
                            href="#"
                            onclick="deleteCard(this)"
                            class="delete-task-btn"
                            title="Hapus"
                        >
                            <i class="ki-duotone ki-trash text-danger fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a>
                    <i class="ki-duotone ki-cross me-3 fs-1" data-bs-dismiss="modal" style="cursor: pointer;">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    id="form_edit_board"
                    method="POST"
                    class="tbr_main_form"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <input type="hidden" name="id" id="edit_board_id">
                    <input type="hidden" id="current_development_id" value="{{ $developments->first()->id ?? '' }}">

                    <div class="form-group mb-8">
                        <label for="edit_name" class="h6 tbr_font--weight-bold d-block">Nama</label>
                        <input type="text" class="tbr_form form-control w-100" name="name" id="edit_name" placeholder="Nama Kanban Board" />
                    </div>

                    <div class="form-group mb-8">
                        <label for="edit_desc" class="h6 tbr_font--weight-bold d-block">Deskripsi</label>
                        <textarea id="edit_desc" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="desc" data-kt-autosize="true" placeholder="Deskripsi Kanban Board"></textarea>
                    </div>

                    <div class="form-group mb-8">
                        <label class="h6 tbr_font--weight-bold d-block">Lampiran</label>
                        <div class="d-flex align-items-center gap-5">
                            <div class="input-group mb-5">
                                <span class="input-group-text">
                                    <i class="ki-duotone ki-paper-clip fs-2"></i>
                                </span>
                                <input
                                    type="text"
                                    class="tbr_form form-control text-primary text-decoration-underline"
                                    id="edit_link"
                                    name="link"
                                    placeholder="Lampiran Link"
                                />
                            </div>
                            <div class="input-group mb-5">
                                <span class="input-group-text">
                                    <i class="ki-duotone ki-minus-folder fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <label class="tbr_form form-control file-label" for="edit_file">
                                    <span id="edit-file-name">Lampiran File</span>
                                </label>
                                <input type="file" id="edit_file" name="file" class="tbr_form form-control file-input" />
                                <a href="#" id="edit_file_preview" target="_blank" class="btn btn-light">Lihat File</a>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="submitEditForm()" class="btn tbr_btn tbr_btn--primary">Edit Kanban Board</button>
                    </div>
                </form>
                <hr class="tbr_separator my-10">

                {{-- == checklist board == --}}
                <div id="form-checklist" class="form-checkdev row flex-col mb-5">
                    <div class="mb-6">
                        <h5>Checklist</h5>
                        <span class="text-gray-600">Isi formulir di bawah untuk menambah checklist pengembangan setelah menyimpan data pengembangan di atas.</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">UI/UX</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger" onclick="addChecklistForm(this, 'UI/UX', 'edit')">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div id="edit-checklist-ui/ux" class="checklist-form-container mb-4" data-category="UI/UX"></div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">BackEnd</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger" onclick="addChecklistForm(this, 'BackEnd', 'edit')">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div id="edit-checklist-backend" class="checklist-form-container mb-4" data-category="BackEnd"></div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">FrontEnd</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger" onclick="addChecklistForm(this, 'FrontEnd', 'edit')">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div id="edit-checklist-frontend" class="checklist-form-container mb-4" data-category="FrontEnd"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="role" class="h6 tbr_font--weight-bold d-block">Quality Assurance</label>
                        <i class="ki-duotone ki-plus-square fs-2 text-danger" onclick="addChecklistForm(this, 'QA', 'edit')">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <div id="edit-checklist-qa" class="checklist-form-container" data-category="QA"></div>
                </div>
            </div>
        </div>
    </div>
</div>
