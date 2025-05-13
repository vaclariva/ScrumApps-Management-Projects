const allVisibleToggle = $("#all-visible");
$(function () {
    activeSidebarTree({ id: "#sidebar-product-all" });

    // Listen change All Visible
    allVisibleToggle.on("change", function () {
        if (allVisibleToggle.is(":checked")) {
            $('input[name="is_visible"]').prop("checked", true);
        } else {
            $('input[name="is_visible"]').prop("checked", false);
        }
        submitAllVisible();
    });

    // Listen change is_visible
    $('input[name="is_visible"]').on("change", function () {
        logicAllVisible();
        submitForm({ tr: $(this).parents("tr") });
    });

    // Listen change price
    $(document).on(
        "input",
        'input[name="price"]',
        $.debounce(1000, function () {
            if ($(this).val().length > 0) {
                submitForm({ tr: $(this).parents("tr") });
            }
        })
    );
});

function logicAllVisible() {
    let allInputIsVisible = $('input[name="is_visible"]:checked');

    if (allInputIsVisible.length == $('input[name="is_visible"]').length) {
        allVisibleToggle.prop("checked", true);
    } else {
        allVisibleToggle.prop("checked", false);
    }
}

function submitAllVisible() {
    $.ajax({
        url: urlAllVisible,
        method: "POST",
        data: {
            is_visible: allVisibleToggle.is(":checked") ? "1" : "0",
        },
        beforeSend: function(){
            let disabledEl = $('[data-ajax-disabled="true"]');
            disabledEl.prop("readonly", true);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Success" });
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function(){
            let disabledEl = $('[data-ajax-disabled="true"]');
            disabledEl.prop("readonly", false);
        }
    });
}

function submitForm({ tr }) {
    let isVisible = tr.find("input[name='is_visible']:checked").val();
    let price = tr.find("input[name='price']").val();
    $.ajax({
        url: storeUrl,
        method: "POST",
        data: {
            product_variant_id: tr.data("variant-id"),
            is_visible: isVisible,
            price: price,
        },
        beforeSend: function () {
            let disabledEl = $('[data-ajax-disabled="true"]');
            disabledEl.prop("readonly", true);
        },
        success: function (res) {
            showSuccessToast({ message: res?.message ?? "Success" });
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            let disabledEl = $('[data-ajax-disabled="true"]');
            disabledEl.prop("readonly", false);
        },
    });
}
