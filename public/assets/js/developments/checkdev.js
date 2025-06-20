// PREVIEW FILE
document.getElementById('file').addEventListener('change', function() {
    const fileName = this.files[0] ? this.files[0].name : "Lampiran File";
    document.getElementById('file-name').textContent = fileName;
});

// PERKONDISIAN BTN-ACTIONS
$(document).on('focus', '.checklist-editable', function () {
    const $form = $(this).closest('form');
    const $actions = $form.find('.checklist-action-buttons');
    $actions.removeClass('d-none');
    if ($form.attr('data-saved') === 'true') {
        $actions.find('.btn-save-checklist').addClass('d-none');
        $actions.find('.btn-update-checklist').removeClass('d-none');
        $actions.find('.btn-delete-checklist').removeClass('d-none');
        $actions.find('.btn-cancel-checklist').removeClass('d-none');
    } else {
        $actions.find('.btn-save-checklist').removeClass('d-none');
        $actions.find('.btn-update-checklist').addClass('d-none');
        $actions.find('.btn-delete-checklist').addClass('d-none');
        $actions.find('.btn-cancel-checklist').removeClass('d-none');
    }
});

$(document).on('blur', '.checklist-editable', function() {
    const $form = $(this).closest('form');

    if ($form.attr('data-saved') === 'true') {
        const $actions = $form.find('.checklist-action-buttons');
        setTimeout(() => {
            if (!$form.find('.checklist-editable').is(':focus')) {
                $actions.addClass('d-none');
            }
        }, 200);
    }
});

// PERKONDISIAN TOMBOL BATAL
function cancelChecklistForm(button) {
    const $form = $(button).closest('form');
    if ($form.attr('data-saved') === 'true') {
        const $actions = $form.find('.checklist-action-buttons');
        $actions.addClass('d-none');
        $form.find('.checklist-editable').trigger('blur');
    } else {
        $form.remove();
    }
}

// ADD CHECK WITH FOCUS
function addChecklistForm(iconElement, category, modalType) {
    const template = document.getElementById('template-checklist-form');
    const clone = template.content.cloneNode(true);
    const formElement = clone.querySelector('form');
    const statusToggle = formElement.querySelector('.checklist-status-toggle');
    const editableDiv = formElement.querySelector('.checklist-editable');
    formElement.querySelector('.category-value').value = category;
    if (modalType === 'edit') {
        formElement.querySelector('.devId').value = currentEditTaskId || '';
        statusToggle.checked = false;
        editableDiv.style.textDecoration = 'none';
        editableDiv.style.opacity = '1';
        formElement.querySelector('.btn-save-checklist').classList.add('d-none');
        formElement.querySelector('.btn-update-checklist').classList.remove('d-none');
        formElement.querySelector('.btn-delete-checklist').classList.remove('d-none');

    } else {
        formElement.querySelector('.devId').value = currentDevId || '';
        statusToggle.checked = false;
        editableDiv.style.textDecoration = 'none';
        editableDiv.style.opacity = '1';
        formElement.querySelector('.btn-save-checklist').classList.remove('d-none');
        formElement.querySelector('.btn-update-checklist').classList.add('d-none');
        formElement.querySelector('.btn-delete-checklist').classList.add('d-none');
    }
    let targetContainer;
    const cleanCategory = category.toLowerCase().replace(/\s/g, '').replace(/\//g, '');

    if (modalType === 'create') {
        targetContainer = document.getElementById(`create-checklist-${cleanCategory}`);
        if (!targetContainer) {
            console.warn(`Container spesifik create-checklist-${cleanCategory} tidak ditemukan. Mencari dengan class di modal create.`);
            targetContainer = modalCreateBoard.querySelector(`.checklist-form-container[data-category="${category}"]`);
        }
    } else {
        targetContainer = document.getElementById(`edit-checklist-${cleanCategory}`);
        if (!targetContainer) {
            console.warn(`Container spesifik edit-checklist-${cleanCategory} tidak ditemukan. Mencari dengan class di modal edit.`);
            targetContainer = modalEditBoard.querySelector(`.checklist-form-container[data-category="${category}"]`);
        }
    }

    if (targetContainer) {
        targetContainer.appendChild(clone);
        if (editableDiv) {
            editableDiv.focus();
            const range = document.createRange();
            range.selectNodeContents(editableDiv);
            range.collapse(false);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
        }
    } else {
        console.error(`ERROR: Target container untuk kategori "${category}" di modal ${modalType} TIDAK DITEMUKAN.`);
    }
    statusToggle.addEventListener('change', function() {
        if (this.checked) {
            editableDiv.style.textDecoration = 'line-through';
            editableDiv.style.opacity = '0.7';
        } else {
            editableDiv.style.textDecoration = 'none';
            editableDiv.style.opacity = '1';
        }
    });
    editableDiv.addEventListener('input', function() {
        formElement.querySelector('.checklist-hidden-title').value = this.textContent;
    });
}

// SUBMIT CHECKLIST
function submitCheckdev({ el }) {
    const $form = $(el).closest('form');
    const $editable = $form.find('.checklist-editable');
    const $hiddenInput = $form.find('.checklist-hidden-title');
    const $saveButton = $(el);
    const originalButtonHtml = $saveButton.html();
    $hiddenInput.val($editable.text().trim());
    let url = "/check-dev";

    $.ajax({
        url: url,
        type: "POST",
        data: $form.serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $saveButton.attr("disabled", true);
            $saveButton.html(`Tambah <span class='spinner-border spinner-border-sm text-white ms-2'></span>`);
        },
        success: function(response) {
            if (response.check_dev) {
                showSuccessToast({ message: response.message || 'Checklist berhasil ditambahkan!' });
                checkDevs.push(response.check_dev);
                console.log("checkDevs global setelah penambahan:", checkDevs);
                $form.find('.checkdevId').val(response.check_dev.id);
                $form.attr('data-saved', 'true');
                $form.find('.checklist-action-buttons').addClass('d-none');
                const category = $form.find('.category-value').val();
                const modalType = $form.closest('.modal').attr('id') === 'modal_edit_boards' ? 'edit' : 'create';
                addChecklistForm(null, category, modalType);
            } else {
                showErrorToast({ message: response.message || 'Gagal menambahkan checklist.' });
            }
        },
        error: function(xhr) {
            console.error('Error saat submit checklist:', xhr);
            showErrorToast({ message: 'Terjadi kesalahan saat menyimpan checklist.' });
        },
        complete: function() {
            $saveButton.attr("disabled", false);
            $saveButton.html(originalButtonHtml);
        }
    });
}

// UPDATE CHECKLIST
function updateCheckdev({ el }) {
    const $form = $(el).closest('form');
    const $editable = $form.find('.checklist-editable');
    const $hiddenInput = $form.find('.checklist-hidden-title');
    const id = $form.find('.checkdevId').val();

    if (!id) {
        showErrorToast({ message: 'ID checklist tidak ditemukan.' });
        return;
    }

    const url = `/check-dev/${id}`;
    $hiddenInput.val($editable.text().trim());
    let loader = "Simpan <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

    $.ajax({
        url: url,
        type: "POST",
        data: {
            ...$form.serializeArray().reduce((acc, item) => {
                acc[item.name] = item.value;
                return acc;
            }, {}),
            _method: "PUT"
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $(el).attr("disabled", true);
            $(el).html(loader);
        },
        success: function (response) {
            if (response.check_dev) {
                showSuccessToast({ message: response.message || 'Checklist berhasil diperbarui!' });

                $form.attr('data-saved', 'true');
                $form.find('.btn-update-checklist, .btn-delete-checklist').addClass('d-none');
                $form.find('.btn-save-checklist').addClass('d-none');
                $form.find('.btn-cancel-checklist').addClass('d-none');
            } else {
                showErrorToast({ message: response.message || 'Gagal memperbarui checklist.' });
            }
        },
        error: function (xhr) {
            console.error('Error saat update checklist:', xhr);
            showErrorToast({ message: 'Terjadi kesalahan saat memperbarui checklist.' });
        }
    });
}

// UPDATE STATUS
$(document).ready(function() {
    $(document).on('change', '.checklist-status-toggle', function() {
        const checkbox = $(this);
        const formElement = checkbox.closest('.form-checklist');
        const checkDevId = formElement.find('.checkdevId').val();

        const devId = formElement.find('.devId').val();
        const category = formElement.find('.category-value').val();
        const name = formElement.find('.checklist-hidden-title').val();
        const hiddenStatusInput = formElement.find('.checklist-status-hidden');

        const newStatus = checkbox.is(':checked') ? 'active' : 'inactive';

        console.log(`Checkbox dengan ID ${checkDevId} diubah. Status baru: ${newStatus}`);
        console.log(`Mengirim data update: dev_id=${devId}, category=${category}, name=${name}, status=${newStatus}`);
        hiddenStatusInput.val(newStatus);
        console.log(`Nilai hidden input status diperbarui menjadi: ${hiddenStatusInput.val()}`);
        const editableDiv = formElement.find('.checklist-editable');
        if (newStatus === 'active') {
            editableDiv.css({ 'text-decoration': 'line-through', 'opacity': '0.7' });
        } else {
            editableDiv.css({ 'text-decoration': 'none', 'opacity': '1' });
        }

        if (!checkDevId) {
            console.error('ID CheckDev tidak ditemukan untuk update status!');
            showErrorToast({ message: 'Gagal memperbarui: ID checklist tidak ditemukan.' });
            checkbox.prop('checked', !checkbox.is(':checked'));
            hiddenStatusInput.val(newStatus === 'active' ? 'inactive' : 'active');
            return;
        }
        if (!devId || !category || !name) {
            console.error('Data form tidak lengkap untuk update status (dev_id, category, atau name hilang)!');
            showErrorToast({ message: 'Gagal memperbarui: Data form tidak lengkap.' });
            checkbox.prop('checked', !checkbox.is(':checked'));
            hiddenStatusInput.val(newStatus === 'active' ? 'inactive' : 'active');
            return;
        }

        $.ajax({
            url: `/check-dev/${checkDevId}`,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                dev_id: devId,
                category: category,
                name: name,
                status: newStatus
            },
            success: function(response) {
                showSuccessToast({ message: response.message || 'Status checklist berhasil diperbarui!' });
                const updatedCheckdevIndex = checkDevs.findIndex(item => item.id == checkDevId);
                if (updatedCheckdevIndex !== -1) {
                    checkDevs[updatedCheckdevIndex].status = newStatus;
                    console.log("checkDevs global setelah update status:", checkDevs[updatedCheckdevIndex]);
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal memperbarui status:', xhr.responseJSON ? xhr.responseJSON.message : 'Unknown error', xhr, status, error);
                checkbox.prop('checked', !checkbox.is(':checked'));
                hiddenStatusInput.val(newStatus === 'active' ? 'inactive' : 'active');

                let errorMessage = 'Terjadi kesalahan saat memperbarui status.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).join('\n');
                }
                showErrorToast({ message: 'Error: ' + errorMessage }); 
            }
        });
    });
});

// DELETE CHECKLIST
    $(document).ready(function() {
        let checkDevIdToDelete = null;
        function deleteCheckdev(buttonElement) {
            console.log('Fungsi deleteCheckdev dipanggil.');

            const formElement = $(buttonElement).closest('.form-checklist');
            const checkDevId = formElement.find('.checkdevId').val();

            console.log('checkDevId yang ditemukan:', checkDevId);

            if (!checkDevId) {
                console.error('ID CheckDev tidak ditemukan di dalam form!');
                return;
            }

            checkDevIdToDelete = checkDevId;
            $('#tbr_modal_delete_dev').modal('show');
            console.log('Modal delete ditampilkan.');
        }

        $('#tbr_confirm_delete_dev').on('click', function() {
            console.log('Tombol "Ya, hapus" diklik!');

            if (!checkDevIdToDelete) {
                console.error('Tidak ada ID CheckDev yang siap untuk dihapus! checkDevIdToDelete is null.');
                return;
            }

            console.log('Melanjutkan proses penghapusan untuk ID:', checkDevIdToDelete);

            $('#tbr_modal_delete_dev').modal('hide');
            console.log('Modal delete disembunyikan.');

            $.ajax({
                url: `/check-dev/${checkDevIdToDelete}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showSuccessToast({ message: response.message || 'Checklist berhasil diperbarui!' });
                    $(`.form-checklist .checkdevId[value="${checkDevIdToDelete}"]`).closest('.form-checklist').remove();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseJSON.message, xhr, status, error);
                    showErrorToast({ message: 'Terjadi kesalahan saat menghapus checklist.' });
                },
                complete: function() {
                    console.log('AJAX Complete. checkDevIdToDelete direset.');
                    checkDevIdToDelete = null;
                }
            });
        });
        window.deleteCheckdev = deleteCheckdev;
    });
