$(function () {
    activeSidebar({ id: "#sidebar-users" });
    const passwordMeterElement = document.getElementById(
        "kt_password_meter_control"
    );
    const passwordMeter = KTPasswordMeter.getInstance(passwordMeterElement);
    const cbWeakPassword = $("#ensure-weak-password");
    const inputPasswordEl = $('[name="password"]');
    const inputPasswordConfrimationEl = $('[name="password_confirmation"]');
    const progressOneEl = $("#progress-1");

    inputPasswordEl.on("input", function () {
        if ($(this).val().length > 0) {
            $("#parent-password-meter").removeClass("d-none");
            $("#password-info-1").text(
                "Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol."
            );
        } else {
            $("#parent-password-meter").addClass("d-none");
            $("#password-info-1").text(
                "Kosongkan jika tidak ingin mengganti kata sandi."
            );
        }
        let score = passwordMeter.getScore();
        if (score <= 40) {
            $("input[name='is_weak_password']").val(1);
            progressOneEl
                .removeClass("bg-active-success")
                .addClass("bg-active-danger");
            if (score > 0) {
                showElement({ el: cbWeakPassword });
            } else {
                hideElement({ el: cbWeakPassword });
            }
        } else {
            $("input[name='is_weak_password']").val(0);
            progressOneEl
                .addClass("bg-active-success")
                .removeClass("bg-active-danger");
            hideElement({ el: cbWeakPassword });
        }
    });

    inputPasswordConfrimationEl.on("input", function () {
        if ($(this).val().length > 0) {
            $("#password-info-2").addClass("d-none");
        } else {
            $("#password-info-2").removeClass("d-none");
        }
    });
});

function setPreviewPhoto({ el }) {
    let preview = $("#photo-preview");
    let emptyPhoto = $("#empty-photo");
    let photoPathRemove = $('input[name="photo_path_remove"]');

    // get files and create blob from input
    let files = el.files;
    let blob = URL.createObjectURL(files[0]);
    preview.attr("src", blob);

    photoPathRemove.val("0");
    hideElement({ el: emptyPhoto });
    showElement({ el: preview });
}

function deletePhoto() {
    let emptyPhoto = $("#empty-photo");
    let preview = $("#photo-preview");
    let photoPathRemove = $('input[name="photo_path_remove"]');

    photoPathRemove.val("1");
    hideElement({ el: preview });
    showElement({ el: emptyPhoto });
    $("input[name='photo_path']").val("");
}
