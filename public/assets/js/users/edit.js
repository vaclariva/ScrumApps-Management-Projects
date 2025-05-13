$(function () {
    activeSidebar({ id: "#sidebar-users" });
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

function resendEmail({ el, url }) {
    let btnOri = $(el).html();
    let loader = "<span class='spinner spinner-border text-white'></span>";

    $.ajax({
        url: url,
        type: "POST",
        beforeSend: function () {
            $(el).attr("disabled", true);
            $(el).html(loader);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Success" });
        },
        error: function (xhr, status, error) {
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
        },
    });
}
