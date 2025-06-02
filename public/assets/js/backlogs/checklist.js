function submitCheckbacklog({ el }) {
    let form = $(el).closest("form");
    let url = form.attr("action");
    let method = form.attr("method") ?? "POST";
    let formData = new FormData(form[0]);
    let checkBacklogId = form.data('check-backlog-id');
    formData.append('check_backlog_id', checkBacklogId);

    let btnOri = $(el).html();
    let loader = "Tambah <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

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

function toggleChecklistButtons($form, isSaved = false) {
    const $saveButton = $form.find('.btn-save-checklist');
    const $updateButton = $form.find('.btn-update-checklist');
    const $deleteButton = $form.find('.btn-delete-checklist');
    $form.find('.checklist-action-buttons').removeClass('d-none');

    if (isSaved) {
        $saveButton.addClass('d-none');
        $updateButton.removeClass('d-none');
        $deleteButton.removeClass('d-none');
    } else {
        $saveButton.removeClass('d-none');
        $updateButton.addClass('d-none');
        $deleteButton.addClass('d-none');
    }
}

function showChecklistForm(existingChecklist = null, backlogId = null) {
    $('.btn-add-checklist').addClass('d-none');

    const $form = $($('.template-checklist-form').html()).appendTo('.checklist-forms');
    const $checklistTitle = $form.find('.checklist-editable');
    const $checklistIdField = $form.find('.checklist-id-field');
    const $backlogIdField = $form.find('.backlog-id-field');
    const $hiddenTitle = $form.find('.checklist-hidden-title');
    const $checkbox = $form.find('.form-check-input');

    $backlogIdField.val(backlogId || currentBacklogId);
    $checklistTitle.focus();

    const isSaved = !!existingChecklist;

    if (isSaved) {
        $form.attr('data-saved', 'true');
        $checklistIdField.val(existingChecklist.id);
        $checklistTitle.text(existingChecklist.title);
        $hiddenTitle.val(existingChecklist.title);
    } else {
        $form.attr('data-saved', 'false');
    }

    toggleChecklistButtons($form, isSaved);

    $(document).on('focusin', '.checklist-editable', function () {
        const $form = $(this).closest('form');
        console.log('Fokus di checklist!');
        $form.find('.checklist-action-buttons').removeClass('d-none');
    });

    $checklistTitle.on('blur', () => {
        setTimeout(() => {
            if (!$form.has(document.activeElement).length) {
                $form.find('.checklist-action-buttons').addClass('d-none');
            }
        }, 100);
    });
}

$(document).on('click', '.btn-update-checklist', function () {
    const $form = $(this).closest('.form-checklist');
    updateCheckbacklog($form);
});

function checklistSaved(response) {
    const $form = $('.form-checklist').last();
    $form.attr('data-saved', 'true');

    const lastCheck = response.check_backlogs.at(-1);
    if (lastCheck?.id) {
        $form.attr('data-check-backlog-id', lastCheck.id);
        $form.find('.checkBacklogId').val(lastCheck.id);
    }

    toggleChecklistButtons($form, true);
    showSuccessToast({ message: response?.message ?? "Checklist berhasil disimpan!" });
    $('.btn-add-checklist').removeClass('d-none');
    showChecklistForm();

    setTimeout(() => {
        $('.checklist-editable').last().focus();
    }, 50);
}

$(document).on('click', '.btn-update-checklist', function () {
    const $form = $(this).closest('.form-checklist');
    updateCheckbacklog($form);
});

$(document).on('click', '.btn-cancel-checklist', function () {
    const $form = $(this).closest('.form-checklist');
    const isSaved = $form.attr('data-saved') === 'true';

    if (isSaved) {
        $form.find('.checklist-action-buttons').addClass('d-none');
    } else {
        $form.remove();
    }

    if (!$('.form-checklist').toArray().some(f => $(f).has(document.activeElement).length > 0)) {
        $('.btn-add-checklist').removeClass('d-none');
    }
});

$(document).on('focusin', '.checklist-editable', function () {
    $('.checklist-action-buttons').addClass('d-none');
    $(this).closest('.form-checklist').find('.checklist-action-buttons').removeClass('d-none');
    $('.btn-add-checklist').addClass('d-none');
});

$(document).on('focusout', '.checklist-editable', function () {
    const $form = $(this).closest('.form-checklist');
    setTimeout(() => {
        if (!$form.has(document.activeElement).length) {
            $form.find('.checklist-action-buttons').addClass('d-none');
            const anyFocused = $('.form-checklist').toArray().some(f => $(f).has(document.activeElement).length > 0);
            if (!anyFocused) {
                $('.btn-add-checklist').removeClass('d-none');
            }
        }
    }, 100);
});

$(document).on('input', '.checklist-editable', function () {
    const $form = $(this).closest('.form-checklist');
    const updatedTitle = $(this).text().trim();
    $form.find('.checklist-hidden-title').val(updatedTitle);
});

function updateCheckbacklog({ el }) {
    const $form = $(el).closest('.form-checklist');
    const checkBacklogId = $form.attr('data-check-backlog-id');
    const backlogId = $form.find('.backlog-id-field').val();
    const name = $form.find('.checklist-editable').text().trim();

    $form.find('.checklist-hidden-title').val(name);

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('name', name);
    formData.append('backlog_id', backlogId);

    $.ajax({
        url: `/checkBacklogs/${checkBacklogId}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(el).attr('disabled', true)
                .html('Simpan <span class="spinner-border spinner-border-sm text-white ms-2"></span>');
                console.log('checkBacklogId:', checkBacklogId);
                console.log('backlogId:', backlogId);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Berhasil diupdate!" });
        },
        error: function (xhr) {
            showErrorToast({ message: xhr?.responseJSON?.message ?? "Gagal update data." });
        },
        complete: function () {
            $(el).attr('disabled', false).html('Simpan');
        }
    });
}

$(document).on('change', '.checklist-status-toggle', function () {
    const isChecked = $(this).is(':checked');
    let checkBacklogId = $(this).data('id');
    const status = isChecked ? 'active' : 'inactive';
    const $form = $(this).closest('form');
    const $text = $form.find('.checklist-editable');

    if (!checkBacklogId) {
        const form = $(this).closest('form');
        checkBacklogId = form.find('.checkBacklogId').val() || form.data('check-backlog-id');
    }

    if (!checkBacklogId) {
        $(this).prop('checked', !isChecked);
        showErrorToast({ message: 'Checklist belum disimpan. Simpan terlebih dahulu sebelum ubah status.' });
        return;
    }

    if (isChecked) {
        $text.css('text-decoration', 'line-through');
    } else {
        $text.css('text-decoration', 'none');
    }

    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('status', status);

    $.ajax({
        url: `/checkBacklogs/${checkBacklogId}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            console.log(`Updating status to ${status}... (ID: ${checkBacklogId})`);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? 'Status berhasil diupdate' });
        },
        error: function (xhr) {
            showErrorToast({ message: xhr?.responseJSON?.message ?? 'Gagal update status' });
        }
    });
});

let currentDeleteButton = null;
let currentFormToDelete = null;

function deleteCheckbacklog({ el }) {
    const modalEl = document.getElementById("tbr_modal_delete");
    const modal = new bootstrap.Modal(modalEl, { keyboard: false });
    const confirmButton = $("#tbr_confirm_delete");

    const form = $(el).closest("form");
    const checkBacklogId = form.find(".checkBacklogId").val() || form.data("check-backlog-id");

    if (!checkBacklogId) {
        showErrorToast({ message: "ID checklist tidak ditemukan." });
        return;
    }

    currentDeleteButton = confirmButton;
    currentFormToDelete = form;

    modal.show();

    confirmButton.data("checkBacklogId", checkBacklogId);
}

$(document).ready(function () {
    const confirmButton = $("#tbr_confirm_delete");
    const modalEl = document.getElementById("tbr_modal_delete");

    confirmButton.on("click", function (event) {
        event.preventDefault();

        const createButton = $(this);
        const buttonText = createButton.html();
        const checkBacklogId = createButton.data("checkBacklogId");

        if (!checkBacklogId || !currentFormToDelete) {
            showErrorToast({ message: "Data tidak lengkap untuk menghapus." });
            return;
        }

        $.ajax({
            url: `/checkBacklogs/${checkBacklogId}`,
            type: "DELETE",
            data: {
                _token: $("meta[name=csrf-token]").attr("content"),
            },
            beforeSend: function () {
                createButton.prop("disabled", true).html(
                    `Memproses <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                );
            },
            success: function (res) {
                showSuccessToast({ message: res?.message ?? "Berhasil menghapus" });
                currentFormToDelete.remove();
                bootstrap.Modal.getInstance(modalEl).hide();
            },
            error: function (xhr) {
                showErrorToast({
                    message: xhr.responseJSON?.message ?? "Gagal menghapus",
                });
                createButton.prop("disabled", false).html(buttonText);

                if (xhr.responseJSON?.status === "session_expired") {
                    setTimeout(() => window.location.reload(), 1000);
                }
            },
        });
    });

    modalEl.addEventListener("hidden.bs.modal", function () {
        confirmButton.prop("disabled", false).html("Hapus");
        confirmButton.removeData("checkBacklogId");
        currentDeleteButton = null;
        currentFormToDelete = null;
    });
});
