
$(document).ready(function () {
    // Tampilkan form checklist dan fokus ke label
    $("#btn-add-checklist").on("click", function () {
        $(this).addClass("d-none");
        $(".form-checkbacklog").removeClass("d-none");

        const label = $("#editable-label");
        setTimeout(() => {
            label.focus();
            placeCaretAtEnd(label[0]);
        }, 100);
    });

    // Batal tambah checklist
    $("#btn-cancel-checklist").on("click", function () {
        $("#btn-add-checklist").removeClass("d-none");
        $(".form-checkbacklog").addClass("d-none");
        $("#editable-label").text("");
    });

    // Simpan checklist
    $("#btn-save-checklist").on("click", function () {
        const label = $("#editable-label").text().trim();
        const backlogId = $("#backlog-id").val();

        if (label === "") {
            alert("Checklist tidak boleh kosong!");
            return;
        }

        $.ajax({
            url: "{{ route('check-backlogs.store') }}",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            contentType: "application/json",
            data: JSON.stringify({
                name: label,
                backlog_id: backlogId,
                status: "inactive"
            }),
            success: function (data) {
                const checklistItem = `
                    <div class="form-check form-check-custom form-check-solid mb-3">
                        <input class="form-check-input" type="checkbox" />
                        <div class="form-check-label">${label}</div>
                    </div>
                `;
                $("#checklist-wrapper").append(checklistItem);
                $("#btn-cancel-checklist").click(); // Reset form dan tampilkan tombol tambah
            },
            error: function (xhr) {
                console.error(xhr);
                alert("Gagal menyimpan checklist");
            }
        });
    });

    // Helper: agar caret langsung muncul di akhir teks
    function placeCaretAtEnd(el) {
        if (!el) return;
        const range = document.createRange();
        const sel = window.getSelection();
        range.selectNodeContents(el);
        range.collapse(false);
        sel.removeAllRanges();
        sel.addRange(range);
    }
});
