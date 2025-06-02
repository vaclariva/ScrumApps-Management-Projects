let currentDeleteId = null;
let currentFormToDelete = null;

function deleteCard(el) {
    const modalEl = document.getElementById("tbr_modal_delete");
    const modal = new bootstrap.Modal(modalEl, { keyboard: false });
    const confirmButton = $("#tbr_confirm_delete");
    if (!currentEditTaskId) {
        showErrorToast({ message: "ID task tidak ditemukan." });
        return;
    }
    currentDeleteId = currentEditTaskId;
    currentFormToDelete = $(el).closest("form");
    modal.show();
}

$(document).ready(function () {
    const confirmButton = $("#tbr_confirm_delete");
    const modalEl = document.getElementById("tbr_modal_delete");
    confirmButton.on("click", function (event) {
        event.preventDefault();
        const button = $(this);
        const buttonText = button.html();
        if (!currentDeleteId) {
            showErrorToast({ message: "Data tidak lengkap untuk menghapus." });
            return;
        }
        $.ajax({
            url: `/developments/${currentDeleteId}`,
            type: "POST",
            data: {
                _token: $("meta[name=csrf-token]").attr("content"),
                _method: "DELETE",
            },
            beforeSend: function () {
                button.prop("disabled", true).html(
                    `Memproses <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                );
            },
            success: function (res) {
                showSuccessToast({ message: res?.message ?? "Berhasil menghapus." });
                if (currentFormToDelete) {
                    currentFormToDelete.closest(".kanban-card").remove();
                }
                bootstrap.Modal.getInstance(modalEl).hide();
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            },
            error: function (xhr) {
                showErrorToast({
                    message: xhr.responseJSON?.message ?? "Gagal menghapus.",
                });
                button.prop("disabled", false).html(buttonText);
                if (xhr.responseJSON?.status === "session_expired") {
                    setTimeout(() => window.location.reload(), 1000);
                }
            },
        });
    });

    modalEl.addEventListener("hidden.bs.modal", function () {
        confirmButton.prop("disabled", false).html("Hapus");
        currentDeleteId = null;
        currentFormToDelete = null;
    });
});
