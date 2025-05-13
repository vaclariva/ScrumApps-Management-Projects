<div class="modal fade" id="modal_create_teams" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Member</h3>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="{{ route('teams.store') }}"
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
                            <label for="name" class="h6 tbr_font--weight-bold mt-4 d-block">Team Developer</label>
                            <select class="tbr_form form-select form-select-solid" name="user_id" data-control="select2" data-placeholder="Pilih Team Developer" data-hide-search="true">
                                <option value="" selected>Pilih Team Developer</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="role" class="h6 tbr_font--weight-bold d-block">Peran</label>
                            <input id="role" type="text" class="tbr_form form-control" name="role" placeholder="Masukkan Peran Member" />
                            <span class="form-text text-muted text-justify">
                                * Peran berupa UI/UX, BackEnd, FrontEnd, FullStack, atau Quality Assurance.
                            </span>
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
