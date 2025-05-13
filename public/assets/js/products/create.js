const parentNotVariant = $("#parent-not-variant");
$(function () {
    activeSidebarTree({ id: "#sidebar-product-all" });
    // Listen radio variant change
    $('input[name="has_variant"]').on("change", function () {
        let isChecked = $(this).val() == '1';
        $('button[type="submit"]').text(isChecked ? 'Lengkapi Varian & Harga' : "Lengkapi Harga")
        isChecked ? parentNotVariant.fadeOut() : parentNotVariant.fadeIn();
    });
});

function setPreviewPhoto({ el }) {
    let preview = $("#photo-preview");
    let emptyPhoto = $("#empty-photo");

    // get files and create blob from input
    let files = el.files;
    let blob = URL.createObjectURL(files[0]);
    preview.attr("src", blob);
    preview.tooltip("dispose");
    preview.tooltip({
        title: `<img width='300' src='${blob}' />`,
        html: true,
        trigger: "hover focus",
        placement: "right",
        customClass: "tbr_tooltip--mw-fit",
    });

    hideElement({ el: emptyPhoto });
    showElement({ el: preview });
}

function deletePhoto() {
    let emptyPhoto = $("#empty-photo");
    let preview = $("#photo-preview");
    hideElement({ el: preview });
    showElement({ el: emptyPhoto });
    preview.tooltip("dispose");
    $("input[name='feature_image']").val("");
}
