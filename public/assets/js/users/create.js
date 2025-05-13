$(function () {
    activeSidebar({ id: "#sidebar-users" });
});

function setPreviewPhoto({ el }) {
    let preview = $("#photo-preview");
    let emptyPhoto = $("#empty-photo");

    // get files and create blob from input
    let files = el.files;
    let blob = URL.createObjectURL(files[0]);
    preview.attr("src", blob);

    hideElement({ el: emptyPhoto });
    showElement({ el: preview });
}

function deletePhoto() {
    let emptyPhoto = $("#empty-photo");
    let preview = $("#photo-preview");
    hideElement({ el: preview });
    showElement({ el: emptyPhoto });
    $("input[name='photo_path']").val("");
}

function customBeforeSendDefaultAjax() {
    let buttons = $(".card-footer").find(".tbr_btn");
    buttons.attr("disabled", "disabled");
}

function submitAjax({ el }) {
    let form = $(el).closest("form");
    form.find('button[type="submit"]').removeAttr("disabled");
    $(el).attr("type", "submit");
    form.removeAttr("data-success-callback").trigger("submit");
}

function submitAjaxReload({ el }) {
    let form = $(el).closest("form");
    $(el).attr("type", "submit");
    form.attr("data-success-callback", "successCallback").trigger("submit");
}

function completeCallback() {
    let buttons = $(".card-footer").find(".tbr_btn");
    buttons.removeAttr("disabled").removeAttr("type");
}

function successCallback() {
    window.location.href = "";
}
