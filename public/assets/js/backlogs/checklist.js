// SHOW FORM CHECKLIST
function showForm(el = null) {
     console.log("🔥 showForm dijalankan");
    console.log("📦 currentBacklogId:", currentBacklogId);
    // Cari parent terdekat dari tombol yg diklik
    const wrapper = el ? el.closest('#checklist-wrapper') : document.querySelector('#checklist-wrapper');
    console.log('📦 wrapper ditemukan?', wrapper);
    const template = document.querySelector('.template-checklist-form');
    const checklistFormsContainer = wrapper.querySelector('.checklist-forms');
    const btnAddChecklist = wrapper.querySelector('.btn-add-checklist');
    console.log({ template, checklistFormsContainer, btnAddChecklist });

    if (template && checklistFormsContainer && btnAddChecklist) {
        const clonedFormContent = template.content.cloneNode(true);
        const formElement = clonedFormContent.querySelector('.form-checklist');
        const backlogIdField = formElement.querySelector('.backlog-id-field');

        if (backlogIdField && typeof currentBacklogId !== 'undefined') {
            backlogIdField.value = currentBacklogId;
        }

        checklistFormsContainer.appendChild(clonedFormContent);

        requestAnimationFrame(() => {
            const formInDOM = checklistFormsContainer.querySelector('.form-checklist:last-child');
            const checklistEditable = formInDOM.querySelector('.checklist-editable');

            if (checklistEditable) {
                checklistEditable.focus();

                const range = document.createRange();
                const sel = window.getSelection();
                range.selectNodeContents(checklistEditable);
                range.collapse(false);
                sel.removeAllRanges();
                sel.addRange(range);
            }

            const actionButtons = formInDOM.querySelector('.checklist-action-buttons');
            if (actionButtons) {
                actionButtons.classList.remove('d-none');
                actionButtons.querySelector('.btn-update-checklist').classList.add('d-none');
                actionButtons.querySelector('.btn-delete-checklist').classList.add('d-none');
                actionButtons.querySelector('.btn-save-checklist').classList.remove('d-none');
            }
        });

        btnAddChecklist.classList.add('d-none');
    } else {
        console.log("❌ Salah satu elemen tidak ditemukan");
    }
}


// PERKONDISIAN BTN ACTIONS
function toggleChecklistButtons($form, isSaved) {
    const $actionButtons = $form.find('.checklist-action-buttons');

    if (isSaved) {
        // Checklist sudah tersimpan
        $actionButtons.find('.btn-save-checklist').addClass('d-none');
        $actionButtons.find('.btn-update-checklist').removeClass('d-none');
        $actionButtons.find('.btn-delete-checklist').removeClass('d-none');
    } else {
        // Checklist baru
        $actionButtons.find('.btn-save-checklist').removeClass('d-none');
        $actionButtons.find('.btn-update-checklist').addClass('d-none');
        $actionButtons.find('.btn-delete-checklist').addClass('d-none');
    }
}

$(document).on('focusin', '.checklist-editable', function () {
    $('.form-checklist').not($(this).closest('.form-checklist')).find('.checklist-action-buttons').addClass('d-none');
    $(this).closest('.form-checklist').find('.checklist-action-buttons').removeClass('d-none');
    $('.btn-add-checklist').addClass('d-none');
    const $form = $(this).closest('form');
    const isSaved = $form.attr('data-saved') === 'true';
    toggleChecklistButtons($form, isSaved);
});

$(document).on('focusout', '.checklist-editable', function () {
    const $form = $(this).closest('.form-checklist');
    setTimeout(() => {
        const newlyFocused = document.activeElement;
        const isStillInSameForm = $form.has(newlyFocused).length > 0;

        if (!isStillInSameForm) {
            $form.find('.checklist-action-buttons').addClass('d-none');

            const anyFocused = $('.form-checklist').toArray().some(f =>
                $(f).has(document.activeElement).length > 0
            );

            if (!anyFocused) {
                $('.btn-add-checklist').removeClass('d-none');
            }
        }
    }, 100);
});


// CANCEL ACTION
function cancelCheckbacklog(el) {
    const $form = $(el).closest('.form-checklist');
    const isSaved = $form.attr('data-saved') === 'true';

    if (isSaved) {
        $form.find('.checklist-action-buttons').addClass('d-none');
    } else {
        $form.remove();
    }

    const anyFocused = $('.form-checklist').toArray().some(f =>
        $(f).has(document.activeElement).length > 0
    );
    if (!anyFocused) {
        $('.btn-add-checklist').removeClass('d-none');
    }
}

// SUBMIT CHECKLIST
function submitCheckbacklog({ el }) {
    const formElement = $(el).closest('.form-checklist');
    const backlogId = formElement.find('.backlog-id-field').val();
    const checklistName = formElement.find('.checklist-editable').text().trim();
    const checklistStatus = formElement.find('.checklist-status-toggle').is(':checked') ? 'active' : 'inactive';
    formElement.find('.checklist-hidden-title').val(checklistName);

    if (checklistName === '') {
        showErrorToast({ message: 'Nama checklist tidak boleh kosong.' });
        return;
    }
    if (!backlogId) {
        showErrorToast({ message: 'Backlog ID tidak ditemukan. Harap segarkan halaman.' });
        return;
    }

    const formData = {
        backlog_id: backlogId,
        name: checklistName,
        status: checklistStatus,
        _token: $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token di sini juga
    };
    const url = '/check-backlog'; // Pastikan ini URL yang benar untuk menyimpan baru
    const btnOri = $(el).html();
    const loader = "Tambah <span class='spinner-border spinner-border-sm text-white ms-2'></span>";

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        beforeSend: function () {
            $(el).attr("disabled", true).html(loader);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Checklist berhasil ditambahkan!" });
            formElement.attr('data-saved', 'true');

            // Asumsi res.check_backlogs adalah array dan item terakhir adalah yang baru
            if (res.check_backlogs && res.check_backlogs.length > 0) {
                 const newCheckbacklogId = res.check_backlogs[res.check_backlogs.length - 1].id;
                 formElement.find('.checkBacklogId').val(newCheckbacklogId);
            }

            const editButton = document.querySelector(`.btn-edit-backlog[data-id="${backlogId}"]`);
            if (editButton && res.check_backlogs) {
                editButton.setAttribute('data-check-backlogs', JSON.stringify(res.check_backlogs));
            }
            // Sembunyikan tombol "Tambah" dan tampilkan "Simpan"/"Hapus"
            $(el).addClass('d-none'); // Sembunyikan tombol "Tambah" yang baru diklik
            formElement.find('.btn-update-checklist').removeClass('d-none'); // Tampilkan "Simpan"
            formElement.find('.btn-delete-checklist').removeClass('d-none'); // Tampilkan "Hapus"

            formElement.find('.checklist-action-buttons').addClass('d-none'); // Sembunyikan div action buttons
            formElement.find('.checklist-editable').blur(); // Hilangkan fokus

            showForm(); // Tampilkan form checklist baru lagi
        },
        error: function (xhr) {
            if (typeof xhr.responseJSON?.errors === "object") {
                showErrorToast({ message: xhr.responseJSON?.errors, isMessageObject: true });
            } else {
                showErrorToast({ message: xhr.responseJSON?.message ?? "Terjadi kesalahan saat menambahkan checklist.", isMessageObject: false });
            }
        },
        complete: function () {
            $(el).html(btnOri).attr("disabled", false);
        }
    });
}

// UPDATE CHECKLIST
function updateCheckbacklog({ el }) {
    const formElement = $(el).closest('.form-checklist');
    const checkBacklogId = formElement.find('.checkBacklogId').val();
    const backlogId = formElement.find('.backlog-id-field').val();
    const checklistName = formElement.find('.checklist-editable').text().trim();
    const checklistStatus = formElement.find('.checklist-status-toggle').is(':checked') ? 'active' : 'inactive';

    formElement.find('.checklist-hidden-title').val(checklistName);

    if (!checkBacklogId) {
        showErrorToast({ message: 'ID Checklist tidak ditemukan untuk diperbarui.' });
        return;
    }
    if (checklistName === '') {
        showErrorToast({ message: 'Nama checklist tidak boleh kosong.' });
        return;
    }

    const formData = {
        _method: 'PUT', // Tetap gunakan ini untuk method PUT/PATCH
        name: checklistName,
        status: checklistStatus,
        backlog_id: backlogId
    };

    // --- BAGIAN URL DAN CSRF YANG DIMODIFIKASI ---
    // Sesuaikan URL dengan route Laravel Anda: /checkBacklogs/{id}
    const url = `/checkBacklogs/${checkBacklogId}`;

    // Ambil token CSRF dari meta tag jika route ada di web.php
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (csrfToken) {
        formData._token = csrfToken; // Tambahkan token CSRF ke formData
    } else {
        console.error("CSRF token not found. Please ensure meta tag <meta name='csrf-token' content='...'> is present.");
        showErrorToast({ message: 'Terjadi masalah keamanan (CSRF token hilang). Harap refresh halaman.' });
        return;
    }
    // --- AKHIR MODIFIKASI ---

    const btn = $(el);
    const btnOriHtml = btn.html();
    const loaderHtml = "Menyimpan <span class='spinner-border spinner-border-sm text-white ms-2'></span>";

    $.ajax({
        url: url,
        type: 'POST', // Tetap POST karena ada _method: 'PUT' di formData
        data: formData,
        beforeSend: function () {
            btn.attr("disabled", true).html(loaderHtml);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Checklist berhasil diperbarui!" });
        },
        error: function (xhr) {
            if (xhr.status === 419) { // 419 Page Expired seringkali karena CSRF token
                showErrorToast({ message: 'Sesi Anda telah berakhir. Harap refresh halaman.' });
            } else if (typeof xhr.responseJSON?.errors === "object") {
                showErrorToast({ message: xhr.responseJSON.errors, isMessageObject: true });
            } else {
                showErrorToast({ message: xhr.responseJSON?.message ?? "Terjadi kesalahan saat memperbarui checklist.", isMessageObject: false });
            }
        },
        complete: function () {
            btn.html(btnOriHtml).attr("disabled", false);

            const actionButtons = formElement.find('.checklist-action-buttons');
            const editableElement = formElement.find('.checklist-editable')[0];

            actionButtons.addClass('d-none');

            if (editableElement) {
                editableElement.blur();
                editableElement.style.backgroundColor = '';
                editableElement.style.padding = '0';
            }
        }
    });
}

// UPDATE STATUS CHECKLIST
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

// DELETE CHECKLIST
let currentDeleteButton = null;
let currentFormToDelete = null;
function deleteCheckbacklog(el) {
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

// function submitCheckbacklog({ el }) {
//     let form = $(el).closest("form");
//     let url = form.attr("action");
//     let method = form.attr("method") ?? "POST";
//     let formData = new FormData(form[0]);
//     let checkBacklogId = form.data('check-backlog-id');
//     formData.append('check_backlog_id', checkBacklogId);

//     let btnOri = $(el).html();
//     let loader = "Tambah <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

//     $.ajax({
//         url: url,
//         type: method,
//         data: formData,
//         contentType: false,
//         processData: false,
//         beforeSend: function () {
//             $(el).attr("disabled", true);
//             $(el).html(loader);
//         },
//         success: function (res) {
//             let checklists = res.check_backlogs;
//             let checkBacklogIdBaru = checklists[checklists.length - 1]?.id;
//             form.attr("data-check-backlog-id", checkBacklogIdBaru);
//             form.attr("data-saved", "true");
//             form.find(".checkBacklogId").val(checkBacklogIdBaru);


//             if (res?.html) {
//                 $(`#backlog_card_${res.backlog.id}`).remove();

//                 const newCardHTML = newCard({
//                     backlog: res.backlog,
//                     project: res.project
//                 });
//                 $('#list-backlogs').prepend(newCardHTML);
//                 KTMenu.createInstances();
//             }
//             console.log(res);

//             let successCallbackName = form.data("success-callback");
//             if (successCallbackName && typeof window[successCallbackName] === "function") {
//                 window[successCallbackName](res);
//             } else {
//                 showSuccessToast({ message: res?.message ?? "Success" });
//             }
//         },
//         error: function (xhr) {
//             if (typeof xhr.responseJSON?.errors === "object") {
//                 showErrorToast({
//                     message: xhr.responseJSON?.errors,
//                     isMessageObject: true,
//                 });
//             } else {
//                 showErrorToast({
//                     message: xhr.responseJSON?.message,
//                     isMessageObject: false,
//                 });
//             }
//         },
//         complete: function () {
//             $(el).html(btnOri);
//             $(el).attr("disabled", false);

//             let completeCallbackName = form.data("complete-callback");
//             if (completeCallbackName && typeof window[completeCallbackName] === "function") {
//                 window[completeCallbackName]();
//             }
//         }
//     });
// }

// function toggleChecklistButtons($form, isSaved = false) {
//     const $saveButton = $form.find('.btn-save-checklist');
//     const $updateButton = $form.find('.btn-update-checklist');
//     const $deleteButton = $form.find('.btn-delete-checklist');
//     $form.find('.checklist-action-buttons').removeClass('d-none');

//     if (isSaved) {
//         $saveButton.addClass('d-none');
//         $updateButton.removeClass('d-none');
//         $deleteButton.removeClass('d-none');
//     } else {
//         $saveButton.removeClass('d-none');
//         $updateButton.addClass('d-none');
//         $deleteButton.addClass('d-none');
//     }
// }

// function showChecklistForm(existingChecklist = null, backlogId = null) {
//     $('.btn-add-checklist').addClass('d-none');

//     const $form = $($('.template-checklist-form').html()).appendTo('.checklist-forms');
//     const $checklistTitle = $form.find('.checklist-editable');
//     const $checklistIdField = $form.find('.checklist-id-field');
//     const $backlogIdField = $form.find('.backlog-id-field');
//     const $hiddenTitle = $form.find('.checklist-hidden-title');
//     $form.find('.checklist-action-buttons').removeClass('d-none');
//     let finalBacklogId = backlogId;
//     if (!finalBacklogId) {
//         const $activeEditBtn = $('.btn-edit-backlog.active, .btn-edit-backlog[data-id]').first();
//         if ($activeEditBtn.length) {
//             finalBacklogId = $activeEditBtn.data('id');
//         }
//     }
//     finalBacklogId = finalBacklogId || currentBacklogId;
//     $backlogIdField.val(finalBacklogId);
//     $checklistTitle.focus();
//     const isSaved = !!existingChecklist;
//     if (isSaved) {
//         $form.attr('data-saved', 'true');
//         $checklistIdField.val(existingChecklist.id);
//         $checklistTitle.text(existingChecklist.title);
//         $hiddenTitle.val(existingChecklist.title);
//     } else {
//         $form.attr('data-saved', 'false');
//     }
//     toggleChecklistButtons($form, isSaved);
//     $(document).on('focusin', '.checklist-editable', function () {
//         const $form = $(this).closest('form');
//         $form.find('.checklist-action-buttons').removeClass('d-none');
//     });
//     $checklistTitle.on('blur', () => {
//         setTimeout(() => {
//             if (!$form.has(document.activeElement).length) {
//                 $form.find('.checklist-action-buttons').addClass('d-none');
//             }
//         }, 100);
//     });
// }

// $(document).on('click', '.btn-edit-backlog', function () {
//     $('.btn-edit-backlog').removeClass('active'); // reset lainnya
//     $(this).addClass('active');

//     currentBacklogId = $(this).data('id'); // simpan juga ke variabel global
// });


// $(document).on('click', '.btn-update-checklist', function () {
//     const $form = $(this).closest('.form-checklist');
//     updateCheckbacklog($form);
// });

// function checklistSaved(response) {
//     // let checklists = res.check_backlogs;
//     // let checkBacklogIdBaru = checklists[checklists.length - 1]?.id;
//     // form.attr("data-check-backlog-id", checkBacklogIdBaru);
//     // form.find(".checkBacklogId").val(checkBacklogIdBaru);
//     const $form = $('.form-checklist').last();
//     $form.attr('data-saved', 'true');

//     const lastCheck = response.check_backlogs.at(-1);
//     if (lastCheck?.id) {
//         $form.attr('data-check-backlog-id', lastCheck.id);
//         $form.find('.checkBacklogId').val(lastCheck.id);
//     }

//     toggleChecklistButtons($form, true);
//     showSuccessToast({ message: response?.message ?? "Checklist berhasil disimpan!" });
//     $('.btn-add-checklist').removeClass('d-none');
//     showChecklistForm();

//     setTimeout(() => {
//         $('.checklist-editable').last().focus();
//     }, 50);
// }

// $(document).on('click', '.btn-update-checklist', function () {
//     const $form = $(this).closest('.form-checklist');
//     updateCheckbacklog($form);
// });

// $(document).on('click', '.btn-cancel-checklist', function () {
//     const $form = $(this).closest('.form-checklist');
//     const isSaved = $form.attr('data-saved') === 'true';

//     if (isSaved) {
//         $form.find('.checklist-action-buttons').addClass('d-none');
//     } else {
//         $form.remove();
//     }

//     if (!$('.form-checklist').toArray().some(f => $(f).has(document.activeElement).length > 0)) {
//         $('.btn-add-checklist').removeClass('d-none');
//     }
// });


// $(document).on('focusin', '.checklist-editable', function () {
//     $('.form-checklist').not($(this).closest('.form-checklist')).find('.checklist-action-buttons').addClass('d-none');
//     $(this).closest('.form-checklist').find('.checklist-action-buttons').removeClass('d-none');
//     $('.btn-add-checklist').addClass('d-none');
//     const $form = $(this).closest('form');
//     const isSaved = $form.attr('data-saved') === 'true';
//     toggleChecklistButtons($form, isSaved);
// });

// $(document).on('focusout', '.checklist-editable', function () {
//     const $form = $(this).closest('.form-checklist');
//     setTimeout(() => {
//         const newlyFocused = document.activeElement;
//         const isStillInSameForm = $form.has(newlyFocused).length > 0;

//         if (!isStillInSameForm) {
//             $form.find('.checklist-action-buttons').addClass('d-none');

//             const anyFocused = $('.form-checklist').toArray().some(f =>
//                 $(f).has(document.activeElement).length > 0
//             );

//             if (!anyFocused) {
//                 $('.btn-add-checklist').removeClass('d-none');
//             }
//         }
//     }, 100);
// });

// $(document).on('input', '.checklist-editable', function () {
//     const $form = $(this).closest('.form-checklist');
//     const updatedTitle = $(this).text().trim();
//     $form.find('.checklist-hidden-title').val(updatedTitle);
// });

// function updateCheckbacklog({ el }) {
//     const $form = $(el).closest('.form-checklist');
//     const checkBacklogId = $form.attr('data-check-backlog-id');
//     const backlogId = $form.find('.backlog-id-field').val();
//     const name = $form.find('.checklist-editable').text().trim();

//     $form.find('.checklist-hidden-title').val(name);

//     const formData = new FormData();
//     formData.append('_method', 'PUT');
//     formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
//     formData.append('name', name);
//     formData.append('backlog_id', backlogId);


//     $.ajax({
//         url: `/checkBacklogs/${checkBacklogId}`,
//         method: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         beforeSend: function () {
//         $(el).attr('disabled', true).html('Simpan <span class="spinner-border spinner-border-sm text-white ms-2"></span>');
//         },
//         success: function (res) {
//             showSuccessToast({ message: res?.message ?? "Berhasil diupdate!" });
//         },
//         error: function (xhr) {
//             showErrorToast({ message: xhr?.responseJSON?.message ?? "Gagal update data." });
//         },
//         complete: function () {
//             $(el).attr('disabled', false).html('Simpan');
//         }
//     });
// }

// $(document).on('change', '.checklist-status-toggle', function () {
//     const isChecked = $(this).is(':checked');
//     let checkBacklogId = $(this).data('id');
//     const status = isChecked ? 'active' : 'inactive';
//     const $form = $(this).closest('form');
//     const $text = $form.find('.checklist-editable');

//     if (!checkBacklogId) {
//         const form = $(this).closest('form');
//         checkBacklogId = form.find('.checkBacklogId').val() || form.data('check-backlog-id');
//     }

//     if (!checkBacklogId) {
//         $(this).prop('checked', !isChecked);
//         showErrorToast({ message: 'Checklist belum disimpan. Simpan terlebih dahulu sebelum ubah status.' });
//         return;
//     }

//     if (isChecked) {
//         $text.css('text-decoration', 'line-through');
//     } else {
//         $text.css('text-decoration', 'none');
//     }

//     const formData = new FormData();
//     formData.append('_method', 'PUT');
//     formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
//     formData.append('status', status);

//     $.ajax({
//         url: `/checkBacklogs/${checkBacklogId}`,
//         method: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         beforeSend: function () {
//             console.log(`Updating status to ${status}... (ID: ${checkBacklogId})`);
//         },
//         success: function (res) {
//             showSuccessToast({ message: res?.message ?? 'Status berhasil diupdate' });
//         },
//         error: function (xhr) {
//             showErrorToast({ message: xhr?.responseJSON?.message ?? 'Gagal update status' });
//         }
//     });
// });

// let currentDeleteButton = null;
// let currentFormToDelete = null;

// function deleteCheckbacklog({ el }) {
//     const modalEl = document.getElementById("tbr_modal_delete");
//     const modal = new bootstrap.Modal(modalEl, { keyboard: false });
//     const confirmButton = $("#tbr_confirm_delete");

//     const form = $(el).closest("form");
//     const checkBacklogId = form.find(".checkBacklogId").val() || form.data("check-backlog-id");

//     if (!checkBacklogId) {
//         showErrorToast({ message: "ID checklist tidak ditemukan." });
//         return;
//     }

//     currentDeleteButton = confirmButton;
//     currentFormToDelete = form;

//     modal.show();

//     confirmButton.data("checkBacklogId", checkBacklogId);
// }

// $(document).ready(function () {
//     const confirmButton = $("#tbr_confirm_delete");
//     const modalEl = document.getElementById("tbr_modal_delete");

//     confirmButton.on("click", function (event) {
//         event.preventDefault();

//         const createButton = $(this);
//         const buttonText = createButton.html();
//         const checkBacklogId = createButton.data("checkBacklogId");

//         if (!checkBacklogId || !currentFormToDelete) {
//             showErrorToast({ message: "Data tidak lengkap untuk menghapus." });
//             return;
//         }

//         $.ajax({
//             url: `/checkBacklogs/${checkBacklogId}`,
//             type: "DELETE",
//             data: {
//                 _token: $("meta[name=csrf-token]").attr("content"),
//             },
//             beforeSend: function () {
//                 createButton.prop("disabled", true).html(
//                     `Memproses <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
//                 );
//             },
//             success: function (res) {
//                 showSuccessToast({ message: res?.message ?? "Berhasil menghapus" });
//                 currentFormToDelete.remove();
//                 bootstrap.Modal.getInstance(modalEl).hide();
//             },
//             error: function (xhr) {
//                 showErrorToast({
//                     message: xhr.responseJSON?.message ?? "Gagal menghapus",
//                 });
//                 createButton.prop("disabled", false).html(buttonText);

//                 if (xhr.responseJSON?.status === "session_expired") {
//                     setTimeout(() => window.location.reload(), 1000);
//                 }
//             },
//         });
//     });

//     modalEl.addEventListener("hidden.bs.modal", function () {
//         confirmButton.prop("disabled", false).html("Hapus");
//         confirmButton.removeData("checkBacklogId");
//         currentDeleteButton = null;
//         currentFormToDelete = null;
//     });
// });
