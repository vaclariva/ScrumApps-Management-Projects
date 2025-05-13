const spinner =
    '<span class="spinner-border spinner-border-sm tbr_text--warning" role="status" aria-hidden="true"></span>';
const checkListSvg = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.445 3.95079C14.744 4.24975 14.744 4.73447 14.445 5.03344L7.4275 12.051C7.12854 12.3499 6.64382 12.3499 6.34485 12.051L1.56016 7.26629C1.2612 6.96733 1.2612 6.48261 1.56016 6.18364C1.85913 5.88468 2.34385 5.88468 2.64281 6.18364L6.88618 10.427L13.3624 3.95079C13.6614 3.65182 14.1461 3.65182 14.445 3.95079Z" fill="#F6B100"/>
                    </svg>`;
function dtRowCallback(row, data) {
    let productImage = data.product_image;
    if (productImage) {
        let img = $(row).find("img");
        img.tooltip("dispose");
        img.tooltip({
            title: `<img width='300' src='${productImage}' />`,
            html: true,
            trigger: "hover focus",
            placement: "right",
            customClass: "tbr_tooltip--mw-fit",
        });
    }
    let stock = $(row).find(".tbr_preview--text").text();
    if (!stock || stock <= 0) {
        $(row).css("background-color", "rgba(248, 40, 90, .05)");
    }
}

function dtDrawCallback() {
    AutoNumeric.multiple(".autonumeric", {
        allowDecimalPadding: false,
        decimalCharacter: ",",
        digitGroupSeparator: ".",
        minimumValue: 0,
    });
    $('[data-bs-toggle="tooltip"]').tooltip();
}

$(function () {
    activeSidebarTree({ id: "#sidebar-inventory-stock" });
    dtInventoryMinimumStock = initDatatable({
        tableId: "table-inventory-minimum-stock",
        url: urlDatatable,
        data: dataDatatable,
        dtRowCallbackFunctionName: dtRowCallback,
        dtDrawCallbackFunctionName: dtDrawCallback,
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: "variant_name",
                data: "variant_name",
            },
            {
                name: "minimum_stock",
                data: "minimum_stock",
            },
            {
                name: "unit",
                data: "unit",
            },
        ],
    });

    let tbrBackdrop = $(".tbr_backdrop");

    // Listen open filter
    $("#warehouse-id").on("select2:opening", function () {
        tbrBackdrop.fadeIn();
    });

    // Listen open filter
    $("#warehouse-id").on("select2:select", function () {
        dtInventoryMinimumStock.ajax.reload();
    });

    // Listen close filter
    $("#warehouse-id").on("select2:closing", function () {
        tbrBackdrop.fadeOut();
    });

    // Listen enter input
    $(document).on("keyup", ".tbr_input--minimum input", function (e) {
        if (e.keyCode === 13) {
            $(this).siblings('button').trigger('click');
        }
    });
});

function showInputMinimumStock({ el }) {
    let td = $(el).parents("td");
    let previewMinimumParent = td.find(".tbr_preview--minimum");
    let inputMinimumParent = td.find(".tbr_input--minimum");
    let inputEl = inputMinimumParent.find("input");

    previewMinimumParent.addClass("d-none");
    inputMinimumParent.removeClass("d-none").addClass("d-flex");
    inputEl.focus();
}

function updateMinimumStock({ el, url = '' }) {
    let td = $(el).parents("td");
    let previewMinimumParent = td.find(".tbr_preview--minimum");
    let inputMinimumParent = td.find(".tbr_input--minimum");

    let previewText = previewMinimumParent.find(".tbr_preview--text");
    let buttonSubmit = inputMinimumParent.find('button');
    let inputEl = inputMinimumParent.find('input');
    $.ajax({
        url: url,
        type: "POST",
        data: {
            minimum_stock: inputEl.val(),
            warehouse_id: $("#warehouse-id").val(),
        },
        beforeSend: function(){
            buttonSubmit.html(spinner);
            buttonSubmit.attr('disabled', true);
        },
        success: function(res){
            let minimumValue = inputEl.val();
            inputMinimumParent.addClass("d-none").removeClass("d-flex");
            previewMinimumParent.removeClass("d-none").addClass("d-flex");
            if(minimumValue.length == 0){
                minimumValue = 0;
            }
            previewText.text(minimumValue);
            let tr = inputMinimumParent.parents("tr");
            if(minimumValue <= 0){
                tr.css("background-color", "rgba(248, 40, 90, .05)");
            }
            else{
                tr.css("background-color", "transparent");
            }

            showSuccessToast({ message: res?.message ?? "Success" });
        },
        error: function(xhr, status, error){
            showToastError({ xhr: xhr });
        },
        complete: function(){
            buttonSubmit.html(checkListSvg);
            buttonSubmit.attr('disabled', false);
            buttonSubmit.tooltip('hide');
        }
    })
}

function showToastError({ xhr }) {
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
}
