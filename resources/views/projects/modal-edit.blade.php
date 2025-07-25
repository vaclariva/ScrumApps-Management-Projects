<div class="modal fade" id="modal_edit_project" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Proyek</h3>
            </div>
            <div class="modal-body px-10 pt-10 pb-12">
                <form
                    action="{{ route('projects.update', $project->id) }}"
                    method="POST"
                    class="tbr_main_form"
                >
                @method("PATCH")
                    <div class="d-block">
                        <div class="form-group mb-8">
                            <label class="h6 tbr_font--weight-bold d-block">Nama</label>
                            <div class="d-flex align-items-center gap-3 icon-picker-group">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-light btn-icon icon-picker-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="selected-icon {{ $project->icon }} text-gray-500 fs-1">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </button>
                                    <div class="dropdown-menu p-4 icon-picker-dropdown" style="overflow-y: auto;">
                                        <input type="text" class="form-control mb-3 icon-picker-search" placeholder="Cari Icon...">
                                        <div class="icon-picker-grid d-flex flex-wrap gap-3">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" class="icon-picker-input" value="{{ $project->icon }}">
                                <input type="text" class="tbr_form form-control w-100" id="name" name="name" value="{{ $project->name ?? '' }}" placeholder="Masukkan Nama Proyek" />
                            </div>
                        </div>

                        <div class="form-group mb-8">
                            <label for="name" class="h6 tbr_font--weight-bold mt-4 d-block">Label</label>
                            <div class="d-flex gap-20">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="internal" name="label" id="internal"  {{ $project->label == 'internal' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="internal">
                                        Internal
                                    </label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" value="external" name="label" id="external"  {{ $project->label == 'external' ? 'checked' : '' }}/>
                                    <label class="form-check-label" for="external">
                                        Eksternal
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label for="name" class="h6 tbr_font--weight-bold mt-4 d-block">Tanggal Mulai</label>
                            <div class="input-group flex-root single-date-picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <span class="input-group-text" data-td-target="#date" data-td-toggle="datetimepicker">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z" fill="#A1A5B7"/>
                                        <path opacity="0.4" d="M20 9.84375C20.55 9.84375 21 10.2937 21 10.8438V17.0038C21 20.0038 19.5 22.0038 16 22.0038H8C4.5 22.0038 3 20.0038 3 17.0038V10.8438C3 10.2937 3.45 9.84375 4 9.84375H20Z" fill="#A1A5B7"/>
                                        <path d="M8.5 14.9989C8.24 14.9989 7.98 14.8889 7.79 14.7089C7.61 14.5189 7.5 14.2589 7.5 13.9989C7.5 13.7389 7.61 13.4789 7.79 13.2889C8.07 13.0089 8.51 12.9189 8.88 13.0789C9.01 13.1289 9.12 13.1989 9.21 13.2889C9.39 13.4789 9.5 13.7389 9.5 13.9989C9.5 14.2589 9.39 14.5189 9.21 14.7089C9.02 14.8889 8.76 14.9989 8.5 14.9989Z" fill="#A1A5B7"/>
                                        <path d="M12 14.9989C11.74 14.9989 11.48 14.8889 11.29 14.7089C11.11 14.5189 11 14.2589 11 13.9989C11 13.7389 11.11 13.4789 11.29 13.2889C11.38 13.1989 11.49 13.1289 11.62 13.0789C11.99 12.9189 12.43 13.0089 12.71 13.2889C12.89 13.4789 13 13.7389 13 13.9989C13 14.2589 12.89 14.5189 12.71 14.7089C12.66 14.7489 12.61 14.7889 12.56 14.8289C12.5 14.8689 12.44 14.8989 12.38 14.9189C12.32 14.9489 12.26 14.9689 12.2 14.9789C12.13 14.9889 12.07 14.9989 12 14.9989Z" fill="#A1A5B7"/>
                                        <path d="M15.5 15C15.24 15 14.98 14.89 14.79 14.71C14.61 14.52 14.5 14.26 14.5 14C14.5 13.74 14.61 13.48 14.79 13.29C14.89 13.2 14.99 13.13 15.12 13.08C15.3 13 15.5 12.98 15.7 13.02C15.76 13.03 15.82 13.05 15.88 13.08C15.94 13.1 16 13.13 16.06 13.17C16.11 13.21 16.16 13.25 16.21 13.29C16.39 13.48 16.5 13.74 16.5 14C16.5 14.26 16.39 14.52 16.21 14.71C16.16 14.75 16.11 14.79 16.06 14.83C16 14.87 15.94 14.9 15.88 14.92C15.82 14.95 15.76 14.97 15.7 14.98C15.63 14.99 15.56 15 15.5 15Z" fill="#A1A5B7"/>
                                        <path d="M8.5 18.5C8.37 18.5 8.24 18.47 8.12 18.42C7.99 18.37 7.89 18.3 7.79 18.21C7.61 18.02 7.5 17.76 7.5 17.5C7.5 17.24 7.61 16.98 7.79 16.79C7.89 16.7 7.99 16.63 8.12 16.58C8.3 16.5 8.5 16.48 8.7 16.52C8.76 16.53 8.82 16.55 8.88 16.58C8.94 16.6 9 16.63 9.06 16.67C9.11 16.71 9.16 16.75 9.21 16.79C9.39 16.98 9.5 17.24 9.5 17.5C9.5 17.76 9.39 18.02 9.21 18.21C9.16 18.25 9.11 18.3 9.06 18.33C9 18.37 8.94 18.4 8.88 18.42C8.82 18.45 8.76 18.47 8.7 18.48C8.63 18.49 8.57 18.5 8.5 18.5Z" fill="#A1A5B7"/>
                                        <path d="M12 18.5031C11.74 18.5031 11.48 18.3931 11.29 18.2131C11.11 18.0231 11 17.7631 11 17.5031C11 17.2431 11.11 16.9831 11.29 16.7931C11.66 16.4231 12.34 16.4231 12.71 16.7931C12.89 16.9831 13 17.2431 13 17.5031C13 17.7631 12.89 18.0231 12.71 18.2131C12.52 18.3931 12.26 18.5031 12 18.5031Z" fill="#A1A5B7"/>
                                        <path d="M15.5 18.5031C15.24 18.5031 14.98 18.3931 14.79 18.2131C14.61 18.0231 14.5 17.7631 14.5 17.5031C14.5 17.2431 14.61 16.9831 14.79 16.7931C15.16 16.4231 15.84 16.4231 16.21 16.7931C16.39 16.9831 16.5 17.2431 16.5 17.5031C16.5 17.7631 16.39 18.0231 16.21 18.2131C16.02 18.3931 15.76 18.5031 15.5 18.5031Z" fill="#A1A5B7"/>
                                    </svg>
                                </span>
                                <input type="text" id="start_date_project" name="start_date" class="tbr_form form-control date" placeholder="Pilih tanggal" value="{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->translatedFormat('d F Y, H:i') : '' }}" data-td-target="#start_date_project" />
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label for="name" class="h6 tbr_font--weight-bold mt-4 d-block"> Tanggal Berakhir </label>
                            <div class="input-group flex-root single-date-picker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                <span class="input-group-text" data-td-target="#date" data-td-toggle="datetimepicker">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.7502 3.56V2C16.7502 1.59 16.4102 1.25 16.0002 1.25C15.5902 1.25 15.2502 1.59 15.2502 2V3.5H8.75023V2C8.75023 1.59 8.41023 1.25 8.00023 1.25C7.59023 1.25 7.25023 1.59 7.25023 2V3.56C4.55023 3.81 3.24023 5.42 3.04023 7.81C3.02023 8.1 3.26023 8.34 3.54023 8.34H20.4602C20.7502 8.34 20.9902 8.09 20.9602 7.81C20.7602 5.42 19.4502 3.81 16.7502 3.56Z" fill="#A1A5B7"/>
                                        <path opacity="0.4" d="M20 9.84375C20.55 9.84375 21 10.2937 21 10.8438V17.0038C21 20.0038 19.5 22.0038 16 22.0038H8C4.5 22.0038 3 20.0038 3 17.0038V10.8438C3 10.2937 3.45 9.84375 4 9.84375H20Z" fill="#A1A5B7"/>
                                        <path d="M8.5 14.9989C8.24 14.9989 7.98 14.8889 7.79 14.7089C7.61 14.5189 7.5 14.2589 7.5 13.9989C7.5 13.7389 7.61 13.4789 7.79 13.2889C8.07 13.0089 8.51 12.9189 8.88 13.0789C9.01 13.1289 9.12 13.1989 9.21 13.2889C9.39 13.4789 9.5 13.7389 9.5 13.9989C9.5 14.2589 9.39 14.5189 9.21 14.7089C9.02 14.8889 8.76 14.9989 8.5 14.9989Z" fill="#A1A5B7"/>
                                        <path d="M12 14.9989C11.74 14.9989 11.48 14.8889 11.29 14.7089C11.11 14.5189 11 14.2589 11 13.9989C11 13.7389 11.11 13.4789 11.29 13.2889C11.38 13.1989 11.49 13.1289 11.62 13.0789C11.99 12.9189 12.43 13.0089 12.71 13.2889C12.89 13.4789 13 13.7389 13 13.9989C13 14.2589 12.89 14.5189 12.71 14.7089C12.66 14.7489 12.61 14.7889 12.56 14.8289C12.5 14.8689 12.44 14.8989 12.38 14.9189C12.32 14.9489 12.26 14.9689 12.2 14.9789C12.13 14.9889 12.07 14.9989 12 14.9989Z" fill="#A1A5B7"/>
                                        <path d="M15.5 15C15.24 15 14.98 14.89 14.79 14.71C14.61 14.52 14.5 14.26 14.5 14C14.5 13.74 14.61 13.48 14.79 13.29C14.89 13.2 14.99 13.13 15.12 13.08C15.3 13 15.5 12.98 15.7 13.02C15.76 13.03 15.82 13.05 15.88 13.08C15.94 13.1 16 13.13 16.06 13.17C16.11 13.21 16.16 13.25 16.21 13.29C16.39 13.48 16.5 13.74 16.5 14C16.5 14.26 16.39 14.52 16.21 14.71C16.16 14.75 16.11 14.79 16.06 14.83C16 14.87 15.94 14.9 15.88 14.92C15.82 14.95 15.76 14.97 15.7 14.98C15.63 14.99 15.56 15 15.5 15Z" fill="#A1A5B7"/>
                                        <path d="M8.5 18.5C8.37 18.5 8.24 18.47 8.12 18.42C7.99 18.37 7.89 18.3 7.79 18.21C7.61 18.02 7.5 17.76 7.5 17.5C7.5 17.24 7.61 16.98 7.79 16.79C7.89 16.7 7.99 16.63 8.12 16.58C8.3 16.5 8.5 16.48 8.7 16.52C8.76 16.53 8.82 16.55 8.88 16.58C8.94 16.6 9 16.63 9.06 16.67C9.11 16.71 9.16 16.75 9.21 16.79C9.39 16.98 9.5 17.24 9.5 17.5C9.5 17.76 9.39 18.02 9.21 18.21C9.16 18.25 9.11 18.3 9.06 18.33C9 18.37 8.94 18.4 8.88 18.42C8.82 18.45 8.76 18.47 8.7 18.48C8.63 18.49 8.57 18.5 8.5 18.5Z" fill="#A1A5B7"/>
                                        <path d="M12 18.5031C11.74 18.5031 11.48 18.3931 11.29 18.2131C11.11 18.0231 11 17.7631 11 17.5031C11 17.2431 11.11 16.9831 11.29 16.7931C11.66 16.4231 12.34 16.4231 12.71 16.7931C12.89 16.9831 13 17.2431 13 17.5031C13 17.7631 12.89 18.0231 12.71 18.2131C12.52 18.3931 12.26 18.5031 12 18.5031Z" fill="#A1A5B7"/>
                                        <path d="M15.5 18.5031C15.24 18.5031 14.98 18.3931 14.79 18.2131C14.61 18.0231 14.5 17.7631 14.5 17.5031C14.5 17.2431 14.61 16.9831 14.79 16.7931C15.16 16.4231 15.84 16.4231 16.21 16.7931C16.39 16.9831 16.5 17.2431 16.5 17.5031C16.5 17.7631 16.39 18.0231 16.21 18.2131C16.02 18.3931 15.76 18.5031 15.5 18.5031Z" fill="#A1A5B7"/>
                                    </svg>
                                </span>
                                <input type="text" id="end_date" name="end_date" class="tbr_form form-control date" placeholder="Pilih tanggal" value="{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->translatedFormat('d F Y, H:i') : '' }}" data-td-target="#end_date" />
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label for="name" class="h6 tbr_font--weight-bold mt-4 d-block">Business Analyst</label>
                            <select name="user_id" class="tbr_form form-control form-select form-select-solid" id="user" data-control="select2">
                                <option value="" selected disabled>Pilih Business Analyst</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        data-image="{{ $user->photo_path ? asset($user->photo_path) : asset('assets/images/avatar.png') }}"
                                        {{ (old('user_id', $project->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
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
