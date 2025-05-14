<div class="modal fade" id="modal_edit_teams" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Member</h3>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="#"
                    method="POST"
                    id="updateTeamForm"
                    class="tbr_main_form"
                >
                @csrf
                @method("PATCH")
                    <div class="d-block">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="form-group mb-8">
                            <label  for="team_user" class="h6 tbr_font--weight-bold mt-4 d-block">Team Developer</label>
                            <select id="team_user" class="tbr_form form-select form-select-solid" name="user_id" data-control="select2" data-placeholder="Pilih Team Developer" data-hide-search="true">
                                <option value="" selected>Pilih Team Developer</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-8 align-items-center">
                            <label for="team_role" class="h6 tbr_font--weight-bold d-block">Peran</label>
                            <select id="team_role" class="tbr_form form-select form-select-solid" name="role" data-control="select2" data-placeholder="Pilih Peran" data-hide-search="true">
                                <option value="ui/ux" selected>UI/UX</option>
                                <option value="backend" selected>BackEnd</option>
                                <option value="frontend" selected>FrontEnd</option>
                                <option value="fullstack" selected>FullStack</option>
                                <option value="quality_assurance" selected>Quality Assurance</option>
                            </select>
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
