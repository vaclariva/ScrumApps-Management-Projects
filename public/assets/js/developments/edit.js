let currentEditTaskId = null;

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
    const modal = new bootstrap.Modal(document.getElementById('modal_edit_boards'));
    modal.show();
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


