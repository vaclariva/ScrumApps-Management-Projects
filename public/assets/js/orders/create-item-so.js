const extraDiscountInput = $("#extra-discount-input");
const extraDiscountText = $("#extra-discount-text");
const shippingCostInput = $("#shipping-cost-input");
const shippingCostText = $("#shipping-cost-text");
let totalDiscount =  $('#extra-discount-text');
let totalShipCost =  $('#shipping-cost-text');

$(function(){
    let tbrBackdrop = $(".tbr_backdrop");

    $("#type").on("select2:opening", function () {
        tbrBackdrop.fadeIn();
    });

    $("#type").on("select2:closing", function () {
        tbrBackdrop.fadeOut();
    });

    $("#type").on("select2:select", function () {
        $("#tbr_modal_type").modal("show");
    });

    // Listen enter button edit extra discount
    $("#extra-discount-input").keyup(function (e) {
        if (e.keyCode === 13) {
            doneEditExtraDiscount({ el: "#edit-discount-button" });
        }
    });

    // Listen enter button edit shipping cost
    $("#shipping-cost-input").keyup(function (e) {
        if (e.keyCode === 13) {
            doneEditShippingCost({ el: "#edit-shipping-cost-button" });
        }
    });
})

function editExtraDiscount({ el }) {
    el = $(el);
    el.attr("onClick", "doneEditExtraDiscount({el: this})");
    hideElement({ el: $("#edit-extra-discount") });
    hideElement({ el: extraDiscountText });
    showElement({ el: $("#done-edit-extra-discount") });
    showElement({ el: extraDiscountInput });
}

function doneEditExtraDiscount({ el }) {
    el = $(el);
    el.attr("onClick", "editExtraDiscount({el: this})");
    let valueDiscount = AutoNumeric.getAutoNumericElement("[name=extra_discount]").getNumber();
    totalDiscount.html(rupiah(valueDiscount, true));

    let beforeSendCallback = () => {
        el.attr("disabled", true);
    };
    let successCallback = (res)=>{
        hideElement({ el: $("#done-edit-extra-discount") });
        hideElement({ el: extraDiscountInput });
        showElement({ el: $("#edit-extra-discount") });
        showElement({ el: extraDiscountText });
        el.attr("disabled", false);
    }
    updateSalesOrder({beforeSendCallback: beforeSendCallback ,successCallback: successCallback });
}

function editShippingCost({ el }) {
    el = $(el);
    el.attr("onClick", "doneEditShippingCost({el: this})");
    hideElement({ el: $("#edit-shipping-cost") });
    hideElement({ el: shippingCostText });
    showElement({ el: $("#done-edit-shipping-cost") });
    showElement({ el: shippingCostInput });
}

function doneEditShippingCost({ el }) {
    el = $(el);
    el.attr("onClick", "editShippingCost({el: this})");
    let valueShippingCost = $("[name=shipping_cost]").val();
    totalShipCost.html(valueShippingCost);

    let beforeSendCallback = () => {
        el.attr("disabled", true);
    };

    let successCallback = (res)=>{
        hideElement({ el: $("#done-edit-shipping-cost") });
        hideElement({ el: shippingCostInput });
        showElement({ el: $("#edit-shipping-cost") });
        showElement({ el: shippingCostText });
        el.attr("disabled", false);
    }
    updateSalesOrder({
        beforeSendCallback: beforeSendCallback,
        successCallback: successCallback,
    });
}

function cancelChangeProductType({ el }) {
    let val = $("#type").val();
    if (val === "Popular") {
        $("#type").val("Pengembangan").trigger("change");
    }
    if (val === "Pengembangan") {
        $("#type").val("Popular").trigger("change");
    }
    $(el).parents(".modal").modal("hide");
}

function changeProductType({ el }) {
    let button = $(el);
    let buttonOri = button.html();
    let loader =
        "<span class='spinner spinner-border spinner-border-sm text-white'></span>";
    $.ajax({
        url: urlChangeProductType,
        method: "DELETE",
        data: {
            product_order_type: $("#type").val(),
        },
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        success: function (res) {
            getOrderProducts();
            dtProducts.ajax.reload();
            $(".type--text").text($("#type").val());

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
            button.html(buttonOri);
            button.attr("disabled", false);
            button.parents(".modal").modal("hide");
        },
    });
}
