$(function(){
    activeSidebarTree({ id: "#sidebar-product-all" });

    // Listen change is_visible
    $('input[name="is_visible"]').on('change', function(){
        submitForm();
    })

    // Listen change price
    $('input[name="price"]').on('input', $.debounce(1000, function(){
        if($(this).val().length > 0) {
            submitForm();
        }
    }));

    // Listen change price star
    $('input[name="star_price"]').on("input", $.debounce(1000, function () {
        if ($(this).val().length > 0) {
            submitForm();
        }
    }));
});

function customBeforeSendDefaultAjax() {
    let disabledEl = $('[data-ajax-disabled="true"]');
    disabledEl.prop("readonly", true);
}

function completeCallback() {
    let disabledEl = $('[data-ajax-disabled="true"]');
    disabledEl.prop("readonly", false);
}

function submitForm(){
    $("#form-b2b").trigger("submit");
}
