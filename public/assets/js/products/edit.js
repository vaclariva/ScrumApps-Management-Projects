const parentNotVariant = $("#parent-not-variant");
$(function () {
    activeSidebarTree({ id: "#sidebar-product-all" });

    // Auto select categories
    $('select[name="categories[]"]')
        .val(selectedCategoriesId)
        .trigger("change");

    // Listen name change
    $('input[name="name"]').on(
        "keyup",
        $.debounce(1000, function () {
            if ($(this).val().length > 0) {
                submitForm();
            }
        })
    );

    // Listen categories change
    $('select[name="categories[]"]').on(
        "change",
        $.debounce(1000, function () {
            submitForm();
        })
    );

    // Listen radio variant change
    $('input[name="has_variant"]').on("change", function () {
        let isChecked = $(this).val() == "1";
        let navVariant = $("#tab-variant");
        if (isChecked) {
            navVariant.fadeIn();
            parentNotVariant.fadeOut()
        } else {
            navVariant.fadeOut();
            parentNotVariant.fadeIn();
        }
        submitForm();
    });

    // Listen change unit
    $('select[name="unit_id"]').on("select2:select", function () {
        submitForm();
    });

    // Listen change minimum stock
    $("input[name='minimum_stock']").on("input", $.debounce(1000, function () {
        if($(this).val().length > 0){
            submitForm();
        }
    }));

    // Listen radio variant change
    $('input[name="type"]').on("change", function () {
        submitForm();
    });
});

function submitForm() {
    $("#form-detail").trigger("submit");
}

function customBeforeSendDefaultAjax() {
    let disabledEl = $('[data-ajax-disabled="true"]');
    disabledEl.prop("readonly", true);
}

function completeCallback() {
    let disabledEl = $('[data-ajax-disabled="true"]');
    disabledEl.prop("readonly", false);
}

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

    submitForm();
}

function deletePhoto() {
    let emptyPhoto = $("#empty-photo");
    let preview = $("#photo-preview");
    hideElement({ el: preview });
    showElement({ el: emptyPhoto });
    preview.tooltip('dispose');
    $("input[name='feature_image']").val("");
}
