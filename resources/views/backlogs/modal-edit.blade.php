<div class="modal fade" id="modal_edit_backlog" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h3 class="modal-title">Edit Sprint</h3>
                </button>
                <i class="ki-duotone ki-cross me-3 fs-1" data-bs-dismiss="modal" style="cursor: pointer;">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    id="editBacklogForm"
                    action="{{ route('backlogs.update', $backlog->id) }}"
                    method="POST"
                    class="tbr_main_form"
                    data-type="update"
                    data-is-update="{{ isset($backlog) ? 'true' : 'false' }}"
                >
                @method("PATCH")
                    <div class="d-block">
                        <input type="hidden" name="project_id" id="project_id">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row form-group mb-10 align-items-center">
                            <div class="col-lg-12">
                                <textarea  id="edit_name" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="name" data-kt-autosize="true" placeholder="Masukkan User Story Proyek">{{ $backlog->name ?? '' }}</textarea>
                            </div>
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-text-align-justify-center fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                <label for="description" class="h6 tbr_font--weight-bold d-block mb-0">Deskripsi</label>
                            </div>
                            <div class="col-lg-9">
                                <textarea id="edit_description" class="tbr_form form-control form-control-solid tbr_textarea" name="description" data-kt-autosize="true" placeholder="Masukkan Deskripsi Backlog">{{ $backlog->description ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="row form-group mb-8">
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-directbox-default fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                <label for="priority" class="h6 tbr_font--weight-bold d-block mb-0">Prioritas</label>
                            </div>
                            <div class="form-group col-lg-9">
                                <select class="tbr_form form-select form-select-solid" name="priority" data-control="select2" data-placeholder="Pilih Prioritas" data-hide-search="true">
                                    < <option value="">Pilih Prioritas</option>
                                    <option value="high" {{ $backlog->priority === 'high' ? 'selected' : '' }}>Tinggi</option>
                                    <option value="medium" {{ $backlog->priority === 'medium' ? 'selected' : '' }}>Sedang</option>
                                    <option value="low" {{ $backlog->priority === 'low' ? 'selected' : '' }}>Rendah</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group mb-8 align-items-center">
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-medal-star fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                <label for="status" class="h6 tbr_font--weight-bold d-block mb-0">Status</label>
                            </div>
                            <div class="col-lg-9">
                                <label id="status" class="form-check form-check-inline d-inline-flex align-items-center tbr_input--parent">
                                    <input id="edit_status" class="form-check-input" type="checkbox" name="status" value="active" data-text="Active"
                                        {{ $backlog->status === 'active' ? 'checked' : '' }}/>
                                    <span class="fw-medium ms-3 tbr_text--placeholder-active text-start">
                                        Selesai
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="row form-group mb-8 align-items-center">
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-time fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <label for="sprint" class="h6 tbr_font--weight-bold d-block mb-0">Sprint</label>
                            </div>
                            <div class="col-lg-9">
                                <select class="tbr_form form-select form-select-solid" name="sprint_id" data-control="select2" data-placeholder="Pilih Sprint" data-hide-search="true">
                                    <option value="" {{ old('sprint_id') === null ? 'selected' : '' }}>Pilih Sprint</option>
                                    @foreach ($sprints as $sprint)
                                        <option value="{{ $sprint->id }}">{{ $sprint->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group mb-8 align-items-center">
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-delivery-3 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <label for="applicant" class="h6 tbr_font--weight-bold d-block mb-0">Ditujukan kepada </label>
                            </div>
                            <div class="col-lg-9">
                                <input id="edit_applicant" type="text" class="tbr_form form-control w-100" name="applicant" placeholder="Masukkan Nama Pengguna Fitur" value="{{ $backlog->applicant ?? '' }}" />
                            </div>
                        </div>
                        <div class="row form-group mb-8">
                            <div class="d-flex align-items-center gap-3 col-lg-3 mb-lg-0">
                                <i class="ki-duotone ki-user-tick fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <label class="h6 tbr_font--weight-bold d-block mb-0">Dibuat Oleh</label>
                            </div>
                            <div class="d-flex align-items-center col-lg-9">
                                <img src="{{ $project->user->photo_path ? asset($project->user->photo_path) : asset('assets/images/avatar.png') }}"
                                    alt="{{ $project->user->name }}"
                                    class="w-25px h-25px rounded-circle me-2 object-fit-cover">
                                <span class="text-muted fs-7">{{ $project->user->name }}</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button anim="ripple" type="button" onclick="updateAjax({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan Data Backlog</button>
                            </div>
                        </div>
                    </form>
                    <hr class="tbr_separator my-10">

                    {{-- == checklist backlog == --}}
                    <div id="form-checklist" class="edit-checkbacklog row flex-col mb-5">
                        <div class="mb-6">
                            <h5>Checklist</h5>
                            <span class="text-gray-600">Isi formulir di bawah untuk menambah checklist backlog setelah menyimpan data backlog di atas.</span>
                        </div>

                        <div id="checklist-wrapper">
                            <div class="checklist-forms"></div>
                            <div class="btn-add-checklist mt-5">
                                <a href="#" class="btn btn-light-danger" onclick="showChecklistForm()">Tambah Checklist</a>
                            </div>
                        </div>
                    </div>

                    <template class="template-checklist-form">
                        <form class="form-checklist d-flex flex-column gap-3 mb-3 ini edit"
                            action="{{ route('check-backlog.store') }}"
                            method="POST"
                            data-success-callback="checklistSaved"
                            data-complete-callback="resetChecklistForm"
                            data-check-backlog-id="{{ $checkBacklog->id ?? '' }}"
                            onsubmit="document.querySelector('.checklist-hidden-title').value = document.querySelector('.checklist-editable').innerText.trim();
                                event.preventDefault();
                                submitAjax({ el: this.querySelector('button[type=submit]') });">
                            @csrf
                            <input type="hidden" name="backlog_id" class="backlog-id-field" value="{{ $backlog->id ?? '' }}">
                            <input type="hidden" name="id" class="checkBacklogId" value="{{ $backlog->id ?? '' }}">
                            <div class="form-check checklist-item form-check-solid">
                                <input type="checkbox"
                                    class="form-check-input checklist-status-toggle"
                                    data-id="{{ $checkBacklog->id ?? '' }}"
                                    {{ ($checkBacklog->status ?? '') === 'active' ? 'checked' : '' }}>
                                <input type="hidden" name="name" class="checklist-hidden-title" />
                                <div class="form-check-label checklist-editable"
                                    contenteditable="true"
                                    spellcheck="false"
                                    style="width: 100%; outline: none;"
                                    onfocus="this.style.backgroundColor='#fff5f5'; this.style.borderRadius='0.475rem'; this.style.padding='0.5rem';"
                                    onblur="this.style.backgroundColor=''; this.style.padding='0';">
                                </div>
                            </div>
                            <div class="d-flex gap-3 checklist-action-buttons">
                                <button type="button" onclick="submitCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-save-checklist">Tambah</button>
                                <button type="button" onclick="updateCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-update-checklist d-none">Simpan</button>
                                <button type="button" class="btn btn-sm btn-secondary btn-cancel-checklist">Batal</button>
                                <button type="button" onclick="deleteCheckbacklog({el: this})" class="btn btn-sm btn-secondary btn-delete-checklist d-none">Hapus</button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
