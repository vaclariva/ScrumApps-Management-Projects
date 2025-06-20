<div class="modal fade modal-backlog" id="modal_create_backlogs" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h3 class="modal-title">Tambah Backlog</h3>
                </button>
                <i class="ki-duotone ki-cross me-3 fs-1" data-bs-dismiss="modal" style="cursor: pointer;">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="{{ route('backlogs.store') }}"
                    method="POST"
                    class="tbr_main_form"
                    enctype="multipart/form-data"
                    data-complete-callback="completeCallback"
                    data-success-callback="successCallback"
                >
                @csrf
                    <div class="d-block">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" name="user_id" value="{{ $project->user_id }}">
                        <div class="row form-group mb-10 align-items-center">
                            <div class="col-lg-12">
                                <textarea id="user_story" class="tbr_form form-control form-control-solid mb-8 tbr_textarea" name="name" data-kt-autosize="true" placeholder="Masukkan User Story Proyek"></textarea>
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
                                <textarea id="description" class="tbr_form form-control form-control-solid tbr_textarea" name="description" data-kt-autosize="true" placeholder="Masukkan Deskripsi Backlog"></textarea>
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
                                    <option value="">Pilih Prioritas</option>
                                    <option value="high" >Tinggi</option>
                                    <option value="medium" >Sedang</option>
                                    <option value="low" >Rendah</option>
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
                                    <input class="form-check-input" type="checkbox" name="status" value="active" data-text="Active"/>
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
                                <input id="applicant" type="text" class="tbr_form form-control w-100" name="applicant" placeholder="Masukkan Nama Pengguna Fitur" />
                            </div>
                        </div>
                        <div class="row form-group mb-4">
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
                        </div>
                        <div class="d-flex justify-content-end mb-8">
                            <button anim="ripple" type="button" onclick="submitAjax({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan Data Backlog</button>
                        </div>
                    </div>
                </form>

                <hr class="tbr_separator my-10">

                {{-- == checklist backlog == --}}
                <div id="form-checklist" class="form-checkbacklog row flex-col mb-5 d-none">
                    <div class="mb-6">
                        <h5>Checklist</h5>
                        <span class="text-gray-600">Isi formulir di bawah untuk menambah checklist backlog setelah menyimpan data backlog di atas.</span>
                    </div>
                    <div id="checklist-wrapper">
                        <div class="checklist-forms"></div>
                        <div class="btn-add-checklist mt-5">
                            <a href="#" class="btn btn-light-danger" onclick="showForm(this)">Tambah Checklist</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
