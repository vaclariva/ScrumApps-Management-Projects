const fullscreen = $('#fullscreen');
const salesOrderCollapse = $("#accordion-sales-order");
const inputDate = $("#date");
const inputDateText = $(".date--text");
const buttonInfoPartner = $("#button-info-partner");
const selectWarehouse = $("#warehouse_id");
const selectPartner = $("#partner_id");
const parentRemainingCredit = $("#parent-remaining-credit");
const remainingCredit = $("#remaining-credit");
const addressDelivery = $("#address-delivery");
const parentInfoDelivery = $("#parent-info-delivery");
const partnerNameDestination = $(".partner_name--text");
const warehouseNameDestination = $(".warehouse_name--text");
const headerInfoUnExpanded = $("#header-info-unexpanded");
const headerInfoExpanded = $("#header-info-expanded");
const partnerAddressInput = $("#parnert-address-input");

let lastPartnerId;

$(function(){
    activeSidebarTree({ id: "#sidebar-selling-order" });

    // Listen fullscreen
    fullscreen.on('change', function(){
        let isChecked = $(this).is(":checked");
        if(isChecked){
            openFullscreen({ el: document.documentElement });
        } else {
            closeFullscreen();
        }
    });
    $(document).on("fullscreenchange", function() {
        if(!document.fullscreenElement){
            fullscreen.prop("checked", false);
        }
    })

    // Listen collapse sales order
    salesOrderCollapse.on('shown.bs.collapse', function(){
        hideElement({el: headerInfoExpanded})
        showElement({el: headerInfoUnExpanded})
    });
    salesOrderCollapse.on("hidden.bs.collapse", function () {
        hideElement({ el: headerInfoUnExpanded });
        showElement({ el: headerInfoExpanded });
    });

    // Listen update date
    setInterval(() => {
        inputDate.val(moment().locale("id").format("DD MMMM YYYY, HH:mm"));
        inputDateText.text(moment().locale("id").format("DD MMMM YYYY, HH:mm"));
    }, 1000);

    // Listen warehouse change
    selectWarehouse.on('select2:select', function(event, withUpdate = true){
        let selectedOption = $(this).find('option:selected');
        let dataWarehouse = selectedOption.data("warehouse");
        warehouseNameDestination.text(dataWarehouse.name);
        selectPartner.attr('disabled', false);

        if(withUpdate){
            let beforeSendCallback = () => {
                selectWarehouse.attr("disabled", true);
            };
            let successCallback = () => {
                selectWarehouse.attr("disabled", false);
                getOrderProducts();
            };

            updateSalesOrder({
                beforeSendCallback: beforeSendCallback,
                successCallback: successCallback,
            });
        }

    });

    // Listen partner change
    selectPartner.on('select2:select', function(event, withUpdate = true){
        let selectedOption = $(this).find('option:selected');
        let dataPartner = selectedOption.data("partner");
                $(".tbr_add--product").attr("disabled", false);

        if(dataPartner){
            let shippingAddress = selectPartner.data("shipping-address");
            let hasShippingAddress = shippingAddress != "";

            buttonInfoPartner.tooltip("dispose");
            buttonInfoPartner.tooltip({
                title: `<div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Kelompok:</div>
                            <div class="col-8 text-start">${
                                dataPartner.group ?? "-"
                            }</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Plafon:</div>
                            <div class="col-8 text-start">${rupiah(
                                dataPartner.credit_limit ?? 0
                            )}</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Kota/Kab:</div>
                            <div class="col-8 text-start">${
                                dataPartner.regency_id ?? "-"
                            }</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Kecamatan:</div>
                            <div class="col-8 text-start">${
                                dataPartner.disctrict_id ?? "-"
                            }</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Alamat:</div>
                            <div class="col-8 text-start">${
                                dataPartner.address ?? "-"
                            }</div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-start text-muted">Kontak:</div>
                            <div class="col-8 text-start">${
                                dataPartner.phone_number ?? "-"
                            }</div>
                        </div>
                    </div>`,
                html: true,
                trigger: "click",
                customClass: "tbr_tooltip--mw-fit w-348px",
            });

            remainingCredit.text(rupiah(dataPartner.remaining_credit ?? 0));
            if (hasShippingAddress) {
                addressDelivery.text(shippingAddress);
            } else {
                addressDelivery.text(dataPartner.address ?? "-");
            }
            partnerNameDestination.text(dataPartner.name ?? "-");
            showElement({ el: buttonInfoPartner });
            showElement({ el: parentRemainingCredit });
            showElement({ el: parentInfoDelivery });

            // reset shipping address
            selectPartner.data("shipping-address", "");

            // check is access product dev
            let isAccessProductDev = dataPartner.is_access_product_dev;
            if (!isAccessProductDev) {

                if($('#type').val() == "Pengembangan"){
                    $("#tbr_modal_change_partner").modal('show');
                }
                else{
                    $("#type").val('Popular').trigger('change').attr("disabled", true);
                    ensureSelectPartner(withUpdate);
                }
            } else {
                $("#type").attr("disabled", false);
                ensureSelectPartner(withUpdate);
            }
        }
    })
});

function ensureSelectPartner(withUpdate){
    // reload datatable product
    if (dtProducts) {
        dtProducts.ajax.reload();
    }

    if (withUpdate) {
        let beforeSendCallback = () => {
            selectPartner.attr("disabled", true);
        };
        let successCallback = () => {
            selectPartner.attr("disabled", false);
            getOrderProducts();
        };
        updateSalesOrder({
            beforeSendCallback: beforeSendCallback,
            successCallback: successCallback,
        });
    }

    $("#cancel-change-partner").attr(
        "onClick",
        `cancelChangePartner({el: this, lastPartnerId: ${selectPartner.val()}})`
    );
}

function cancelChangePartner({el, lastPartnerId}){
    el = $(el);
    el.attr(
        "onClick",
        `cancelChangePartner({el: this, lastPartnerId: ${lastPartnerId}})`
    );
    $(el).parents(".modal").modal("hide");
    selectPartner.val(lastPartnerId).trigger("change");
}

function submitChangePartner({el}){
    ensureSelectPartner(true);
    changeProductType({el: ''});
    $("#tbr_modal_change_partner").modal("hide");
    $("#type").val('Popular').trigger('change').attr("disabled", true);
}

function openFullscreen({el}) {
    if (el.requestFullscreen) {
        el.requestFullscreen();
    } else if (el.webkitRequestFullscreen) {
        /* Safari */
        el.webkitRequestFullscreen();
    } else if (el.msRequestFullscreen) {
        /* IE11 */
        el.msRequestFullscreen();
    }
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.webkitExitFullscreen) {
        /* Safari */
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        /* IE11 */
        document.msExitFullscreen();
    }
}

function editDestination({el}){
    el = $(el);
    el.attr('onClick', 'doneEditDestination({el: this})');
    partnerAddressInput.val(addressDelivery.text());

    hideElement({ el: $("#edit-destination") });
    hideElement({ el: addressDelivery });
    showElement({ el: $("#done-edit-destination") });
    showElement({ el: partnerAddressInput });

    let cardBody = el.closest('.card').find('.card-body');
    cardBody.css('cssText', 'padding: 0px !important');
}

function doneEditDestination({el}){
    el = $(el);
    el.attr("onClick", "editDestination({el: this})");
    let beforeSendCallback = ()=>{
        el.attr("disabled", "disabled");
        partnerAddressInput.attr("disabled", "disabled");
    }
    let successCallback = (res)=>{
        el.removeAttr("disabled");
        addressDelivery.text(partnerAddressInput.val());
        partnerAddressInput.removeAttr("disabled");
        hideElement({ el: $("#done-edit-destination") });
        hideElement({ el: partnerAddressInput });
        showElement({ el: $("#edit-destination") });
        showElement({ el: addressDelivery });

        let cardBody = el.closest(".card").find(".card-body");
        cardBody.css("cssText", "padding: 20px !important");
    }
    updateSalesOrder({beforeSendCallback: beforeSendCallback, successCallback: successCallback});
}

function updateSalesOrder({ beforeSendCallback = () => {}, successCallback = (res) => {} }) {
    let address = partnerAddressInput.val();
    let extraDiscount = AutoNumeric.getAutoNumericElement(
        "[name=extra_discount]"
    ).getNumber();
    let shippingCost = AutoNumeric.getAutoNumericElement(
        "[name=shipping_cost]"
    ).getNumber();
    let warehouse_id = selectWarehouse.val();
    let partner_id = selectPartner.val();

    $.ajax({
        url: urlUpdateSalesOrder,
        type: "PUT",
        data: {
            shipping_address: address,
            discount: extraDiscount,
            shipping_cost: shippingCost,
            warehouse_id: warehouse_id,
            partner_id: partner_id,
            note: noteInput.val(),
        },
        beforeSend: beforeSendCallback,
        success: function(res){
            calculateGrandTotal();
            successCallback(res);
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
    });
}

function deleteOrder({el}){
    button = $(el);
    let buttonOri = button.html();
    let loader = "<span class='spinner spinner-border spinner-border-sm tbr_text--primary'></span>";
    $.ajax({
        url: urlDeleteOrder,
        method: "DELETE",
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        success: function (res) {
            console.log(res);
            window.location.href = urlIndex;
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
        },
    });
}

function submitOrder({el, withRedirect = true}){
    button = $(el);
    let buttonOri = button.html();
    let loader =
        "<span class='spinner spinner-border spinner-border-sm text-white'></span>";
    $.ajax({
        url: urlSubmitOrder,
        method: "POST",
        data: {
            order_id: orderId,
            warehouse_id: selectWarehouse.val(),
        },
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        success: function (res) {
            console.log(res);
            showSuccessToast({ message: res?.message ?? "Success" });
            setTimeout(() => {
                if (withRedirect) {
                    window.location.href = urlIndex;
                } else {
                    window.location.reload();
                }
            }, 1000);
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
        },
    });
}
