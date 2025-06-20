let currentEditTaskId = null;
const modalEditBoard = document.getElementById('modal_edit_boards');
const modalCreateBoard = document.getElementById('modal_create_boards');

// OPEN MODAL
function openEditModal(task) {
    currentEditTaskId = task.id;
    document.getElementById('edit_board_id').value = task.id;
    document.getElementById('edit_name').value = task.title;
    document.getElementById('edit_desc').value = task.desc;
    document.getElementById('edit_link').value = task.link;
    const editFileNameSpan = document.getElementById('edit-file-name');
    const editFilePreviewLink = document.getElementById('edit_file_preview');
    if (task.file) {
        const fileName = task.file.split(/[\\/]/).pop();
        editFileNameSpan.textContent = fileName;
        editFilePreviewLink.href = '/storage/' + task.file;
        editFilePreviewLink.style.display = 'inline-block';
        editFilePreviewLink.removeAttribute('disabled');
    } else {
        editFileNameSpan.textContent = 'Lampiran File';
        editFilePreviewLink.href = '#';
        editFilePreviewLink.style.display = 'none';
        editFilePreviewLink.setAttribute('disabled', 'true');
    }
    const form = document.getElementById('form_edit_board');
    form.action = `/developments/${task.id}`;
    modalEditBoard.querySelectorAll('.checklist-form-container').forEach(container => {
        container.innerHTML = '';
    });
    const relevantCheckDevs = checkDevs.filter(checkdev => {
        return checkdev.dev_id == task.id;
    });

    if (relevantCheckDevs.length > 0) {
        relevantCheckDevs.forEach(checkdev => {
            const template = document.getElementById('template-checklist-form');
            const clone = template.content.cloneNode(true);
            const formElement = clone.querySelector('.form-checklist');
            const statusToggle = formElement.querySelector('.checklist-status-toggle');
            const editableDiv = formElement.querySelector('.checklist-editable');
            const hiddenStatusInput = formElement.querySelector('.checklist-status-hidden');

            formElement.classList.remove('create');
            formElement.classList.add('update');
            formElement.setAttribute('data-saved', 'true');
            formElement.querySelector('.devId').value = checkdev.dev_id;
            formElement.querySelector('.checkdevId').value = checkdev.id;
            formElement.querySelector('.category-value').value = checkdev.category || '';
            statusToggle.checked = checkdev.status === 'active';
            hiddenStatusInput.value = checkdev.status;

            if (checkdev.status === 'active') {
                editableDiv.style.textDecoration = 'line-through';
                editableDiv.style.opacity = '0.7';
            } else {
                editableDiv.style.textDecoration = 'none';
                editableDiv.style.opacity = '1';
            }
            editableDiv.textContent = checkdev.name;
            formElement.querySelector('.checklist-hidden-title').value = checkdev.name;
            statusToggle.addEventListener('change', function() {
                if (this.checked) {
                    editableDiv.style.textDecoration = 'line-through';
                    editableDiv.style.opacity = '0.7';
                    hiddenStatusInput.value = 'active';
                } else {
                    editableDiv.style.textDecoration = 'none';
                    editableDiv.style.opacity = '1';
                    hiddenStatusInput.value = 'inactive';
                }
            });

            editableDiv.addEventListener('input', function() {
                formElement.querySelector('.checklist-hidden-title').value = this.textContent;
            });
            formElement.querySelector('.checklist-action-buttons').classList.add('d-none');
            const cleanCategory = checkdev.category
                .toLowerCase()
                .replace(/\s/g, '')
            const targetContainerId = `edit-checklist-${cleanCategory}`;

            console.log(`Mencoba menargetkan kontainer: "${targetContainerId}" untuk kategori "${checkdev.category}"`);
            const targetContainer = document.getElementById(targetContainerId);

            if (targetContainer) {
                targetContainer.appendChild(clone);
            } else {
                console.warn(`Container untuk kategori "${checkdev.category}" (ID: ${checkdev.id}) tidak ditemukan di modal EDIT dengan ID: ${targetContainerId}.`);
            }
        });
    }
    const modal = new bootstrap.Modal(modalEditBoard);
    modal.show();
}

// ADD CHECKDEV
function addChecklistForm(element, category, modalType) {
    const template = document.getElementById('template-checklist-form');
    const clone = template.content.cloneNode(true);
    const formElement = clone.querySelector('.form-checklist');
    const statusToggle = formElement.querySelector('.checklist-status-toggle');
    const editableDiv = formElement.querySelector('.checklist-editable');
    formElement.querySelector('.devId').value = (modalType === 'edit' && currentEditTaskId) ? currentEditTaskId : '';
    formElement.querySelector('.category-value').value = category;
    statusToggle.checked = false;
    editableDiv.style.textDecoration = 'none';
    editableDiv.style.opacity = '1';
    statusToggle.addEventListener('change', function() {
        if (this.checked) {
            editableDiv.style.textDecoration = 'line-through';
            editableDiv.style.opacity = '0.7';
        } else {
            editableDiv.style.textDecoration = 'none';
            editableDiv.style.opacity = '1';
        }
    });

    formElement.querySelector('.btn-save-checklist').classList.remove('d-none');
    formElement.querySelector('.btn-update-checklist').classList.add('d-none');
    formElement.querySelector('.btn-delete-checklist').classList.add('d-none');
    editableDiv.addEventListener('input', function() {
        formElement.querySelector('.checklist-hidden-title').value = this.textContent;
    });
    let targetContainerId;
    const cleanCategory = category.toLowerCase().replace(/\s/g, ''); // Tambahkan penggantian slash
    if (modalType === 'create') {
        targetContainerId = `create-checklist-${cleanCategory}`;
    } else {
        targetContainerId = `edit-checklist-${cleanCategory}`;
    }
    const targetContainer = document.getElementById(targetContainerId);

    if (targetContainer) {
        targetContainer.appendChild(clone);
    } else {
        console.warn(`Container untuk kategori "${category}" tidak ditemukan di modal ${modalType} dengan ID: ${targetContainerId}.`);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const editLinkInput = document.getElementById('edit_link');
    let clickTimer = null;
    editLinkInput.addEventListener('click', function (e) {
        const link = this.value.trim();
        if (clickTimer !== null) return;
        clickTimer = setTimeout(() => {
            if (link.startsWith('http')) {
                window.open(link, '_blank');
            }
            clickTimer = null;
        }, 300);
    });
    editLinkInput.addEventListener('dblclick', function (e) {
        clearTimeout(clickTimer);
        clickTimer = null;
        this.focus();
    });
});

document.getElementById('edit_file').addEventListener('change', function() {
    const fileName = this.files[0] ? this.files[0].name : "Lampiran File";
    document.getElementById('edit-file-name').textContent = fileName;
});

function submitEditForm() {
    const form = $('#form_edit_board');
    const submitButton = form.find('button[type="submit"]');

    const taskId = $('#edit_board_id').val();
    const url = `/developments/${taskId}`;

    const formData = new FormData(form[0]);
    formData.append('_method', 'PUT');

    const btnOriHtml = submitButton.html();
    const loaderHtml = "Edit Data Kanban <span class='spinner-border spinner-border-sm text-white ms-2' role='status' aria-hidden='true'></span>";

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            submitButton.attr("disabled", true).html(loaderHtml);
        },
        success: function (res) {
            console.log('Update berhasil:', res);
            showSuccessToast({ message: res?.message ?? "Update Success" });

            if (res.task) {
                const updatedTask = res.task;
                const taskIndex = window.allTasksDetail.findIndex(t => t.id == updatedTask.id);
                if (taskIndex !== -1) {
                    window.allTasksDetail.splice(taskIndex, 1);
                }
                window.allTasksDetail.push(updatedTask);
                if (typeof KTJKanbanDemoColor !== 'undefined' && typeof KTJKanbanDemoColor.reinitializeKanban === 'function') {
                    KTJKanbanDemoColor.reinitializeKanban();
                    setTimeout(() => {
                        const boardContainer = document.querySelector(`[data-id="${updatedTask.status}"] .kanban-drag`);
                        const updatedCard = boardContainer?.querySelector(`[data-eid="${updatedTask.id}"]`);

                        if (boardContainer && updatedCard) {
                            boardContainer.insertBefore(updatedCard, boardContainer.firstChild);
                        }
                    }, 200);
                }
                $('#edit_name').val(updatedTask.title);
                $('#edit_desc').val(updatedTask.desc);
                $('#edit_link').val(updatedTask.link);
                const fileName = updatedTask.file ? updatedTask.file.split(/[\\/]/).pop() : 'Lampiran File';
                $('#edit-file-name').text(fileName);
                const editFilePreviewLink = $('#edit_file_preview');
                if (updatedTask.file) {
                    editFilePreviewLink.attr('href', '/storage/' + updatedTask.file).show();
                } else {
                    editFilePreviewLink.attr('href', '#').hide();
                }
                $('#edit_file').val('');
            }
        },
        error: function (xhr) {
            console.error('Error saat update:', xhr);
            const response = xhr.responseJSON;
            if (typeof response?.errors === "object") {
                showErrorToast({ message: response.errors, isMessageObject: true });
            } else {
                showErrorToast({ message: response?.message ?? "An unknown error occurred." });
            }
        },
        complete: function () {
            submitButton.html(btnOriHtml).attr("disabled", false);
            const completeCallbackName = form.data("complete-callback");
            if (completeCallbackName && typeof window[completeCallbackName] === "function") {
                window[completeCallbackName]();
            }
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function updateTaskStatusInBackend(taskId, newStatus) {
    $.ajax({
        url: `/developments/${taskId}/update-status`,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            status: newStatus
        },
        success: function (res) {
            console.log('Status updated:', res);
            showSuccessToast({ message: 'Status berhasil diperbarui.' });
        },
        error: function (err) {
            console.error('Error saat update status:', err.responseText);
            showErrorToast({ message: 'Gagal memperbarui status.' });
        }
    });
}


