function newCard(res) {
    return `
        <div class="card shadow-sm mb-6" id="backlog_card_${res.backlog.id}">
            <div class="card-header">
                <h3 class="card-title fs-5">${res.backlog.name}</h3>
            </div>
            <div class="card-body" style="padding-top: 8px !important; padding-bottom: 8px !important;">
                <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
                    <div class="d-flex gap-5 align-items-center">

                        <span class="badge ${
                            res.backlog.priority === 'high' ? 'badge-light-danger' :
                            res.backlog.priority === 'medium' ? 'badge-light-warning' :
                            res.backlog.priority === 'low' ? 'badge-light-success' :
                            'badge-light-secondary'
                        }">
                            • ${
                                res.backlog.priority === 'high' ? 'Tinggi' :
                                res.backlog.priority === 'medium' ? 'Sedang' :
                                res.backlog.priority === 'low' ? 'Rendah' :
                                res.backlog.priority
                            }
                        </span>

                        ${res.backlog.description ? `
                        <i class="ki-duotone ki-text-align-justify-center fs-2">
                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                        </i>` : ''}

                        ${res.backlog.sprint ? `
                        <div class="d-flex align-items-center text-muted gap-1">
                            <i class="ki-duotone ki-time fs-2"><span class="path1"></span><span class="path2"></span></i>
                            <span class="fs-7">${res.backlog.sprint.name}</span>
                        </div>` : ''}

                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-check-square text-success fs-2 gap-1">
                                <span class="path1"></span><span class="path2"></span>
                            </i>
                            <span class="text-success">3/3</span>
                        </div>

                        ${res.backlog.status === 'active' ? `
                        <div class="d-flex align-items-center gap-1">
                            <i class="ki-duotone ki-medal-star text-success fs-2">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                            </i>
                            <span class="text-success">Selesai</span>
                        </div>` : ''}

                        <div class="d-flex align-items-center">
                            <img src="${res.project.user?.photo_path ?? '/assets/images/avatar.png'}"
                                alt="${res.project.user?.name ?? 'Tidak diketahui'}"
                                class="w-25px h-25px rounded-circle me-2 object-fit-cover">
                            <span class="text-muted fs-7">${res.project.user?.name ?? 'Tidak diketahui'}</span>
                        </div>
                    </div>

                    <div>
                        <button type="button" class="btn btn-icon tbr_btn--primary rotate"
                            data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"
                            data-kt-menu-offset="0px, 0px">
                            <i class="ki-duotone ki-dots-circle-vertical tbr_text--primary fs-2qx rotate-90">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span>
                            </i>
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px mw-300px py-4 px-2"
                            data-kt-menu="true">
                            <div class="menu-item px-4">
                                <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded btn-edit-backlog"
                                    data-id="${res.backlog.id}"
                                    data-name="${res.backlog.name}"
                                    data-description="${res.backlog.description}"
                                    data-priority="${res.backlog.priority}"
                                    data-status="${res.backlog.status}"
                                    data-sprint-id="${res.backlog.sprint_id}"
                                    data-applicant="${res.backlog.applicant}"
                                    data-project-id="${res.backlog.project_id}"
                                    data-user-id="${res.backlog.user_id}"
                                    data-user-name="${res.project.user?.name}"
                                    data-user-photo="${res.project.user?.photo_path}"
                                    data-check-backlogs="${JSON.stringify(res.check_backlogs ?? [])}">
                                    Edit Backlog
                                </a>
                            </div>
                            <div class="menu-item px-4">
                                <a href="#" class="menu-link px-3 bg-hover-light-secondary rounded"
                                    onclick="defaultDelete('/backlogs/${res.backlog.id}')">
                                    Hapus Backlog
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}


function submitAjax({ el }) {
    let form = $(el).closest("form");
    let url = form.attr("action");
    let method = form.attr("method") ?? "POST";
    let formData = new FormData(form[0]);
    let checkBacklogs = form.data('check-backlogs');
    formData.append('check_backlogs', JSON.stringify(checkBacklogs));

    let btnOri = $(el).html();
    let loader = "Simpan Data Backlog <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

    $.ajax({
        url: url,
        type: method,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $(el).attr("disabled", true);
            $(el).html(loader);
        },
        success: function (res) {
            console.log('ini:', res.check_backlogs);
            if (res?.html) {
                $(`#backlog_card_${res.backlog.id}`).remove();

                const newCardHTML = newCard({
                    backlog: res.backlog,
                    project: res.project
                });
                $('#list-backlogs').prepend(newCardHTML);
                KTMenu.createInstances();
            }
            console.log(res);

            let successCallbackName = form.data("success-callback");
            if (successCallbackName && typeof window[successCallbackName] === "function") {
                window[successCallbackName](res);
            } else {
                showSuccessToast({ message: res?.message ?? "Success" });
            }
        },
        error: function (xhr) {
            if (typeof xhr.responseJSON?.errors === "object") {
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            $(el).html(btnOri);
            $(el).attr("disabled", false);

            let completeCallbackName = form.data("complete-callback");
            if (completeCallbackName && typeof window[completeCallbackName] === "function") {
                window[completeCallbackName]();
            }
        }
    });
}



// === save checklist backlog === //
let currentBacklogId = null;
let activeChecklistForm = null;

function successCallback(response) {
    currentBacklogId = response.backlog_id;
    $('#backlog-id').val(currentBacklogId);
    $('.form-checkbacklog').removeClass('d-none');
    $('.btn-add-checklist').removeClass('d-none');

    showSuccessToast({ message: response?.message ?? "Success" });
}

$(document).ready(function () {
    $('.btn-edit-backlog').on('click', function (e) {
        e.preventDefault();
        currentBacklogId = $(this).data('id');
    });
});

// $(document).on('submit', '.form-checklist', function (e) {
//     e.preventDefault();

//     const $form = $(this);
//     const text = $form.find('.checklist-editable').text().trim();
//     console.log('Checklist Title:', text);
//     if (text !== "") {
//         submitAjax({ el: $form.find('button[type=submit]')[0] });
//     } else {
//         alert("Name is required!");
//     }
// });


function showChecklistForm() {
    $('.btn-add-checklist').addClass('d-none');

    const $form = $($('.template-checklist-form').html()).appendTo('.checklist-forms');
    $form.find('.backlog-id-field').val(currentBacklogId);

    $form.find('.checklist-editable').focus();
}

function checklistSaved(response) {
    showSuccessToast({ message: response?.message ?? "Checklist berhasil disimpan!" });
    $('.btn-add-checklist').removeClass('d-none');

    showChecklistForm();

    setTimeout(() => {
        $('.checklist-editable').last().focus();
    }, 50);
}

function resetChecklistForm() {
}

$(document).on('click', '.btn-cancel-checklist', function () {
    $(this).closest('.form-checklist').remove();
    $('.btn-add-checklist').removeClass('d-none');
});

$(document).ready(function () {
    // Fokus pada .checklist-editable
    $(document).on('focusin', '.checklist-editable', function () {
        $(this).closest('.form-checklist').find('.checklist-action-buttons').removeClass('d-none');
        $('.btn-add-checklist').addClass('d-none');
    });

    // Fokus keluar dari .checklist-editable
    $(document).on('focusout', '.checklist-editable', function () {
        const $form = $(this).closest('.form-checklist');

        setTimeout(function () {
            if (!$form.has(document.activeElement).length) {
                $form.find('.checklist-action-buttons').addClass('d-none');

                const text = $form.find('.checklist-editable').text().trim();

                const anyFormFocused = $('.form-checklist').toArray().some(f =>
                    $(f).has(document.activeElement).length > 0
                );

                if (!anyFormFocused) {
                    $('.btn-add-checklist').removeClass('d-none');
                    $('.form-checklist').each(function () {
                        const value = $(this).find('.checklist-editable').text().trim();
                        if (value === "") {
                            $(this).remove();
                        }
                    });
                }
            }
        }, 100);
    });
});

$(document).on('input', '.checklist-editable', function () {
    const text = $(this).text().trim();
    $(this).closest('.form-checklist').find('.checklist-hidden-title').val(text);
});


// === reset modal === //
$('#modal_create_backlogs').on('hidden.bs.modal', function () {
    const modal = $(this);
    modal.find('form')[0].reset();
    modal.find('select').val('').trigger('change');
    $('#backlog-id').val('');
    $('.form-checkbacklog').addClass('d-none');
    $('.btn-add-checklist').addClass('d-none');
    $('.checklist-forms').empty();
});

