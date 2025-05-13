const variantParent = $("table tbody");
const emptyVariant = $(".tbr_empty--variant");
const crossSvg = `<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.6203 11.5446C11.4095 11.7542 11.1244 11.8718 10.8271 11.8718C10.5299 11.8718 10.2448 11.7542 10.034 11.5446L0.426523 2.04964C0.321079 1.94506 0.237385 1.82063 0.18027 1.68354C0.123155 1.54645 0.09375 1.39941 0.09375 1.25089C0.09375 1.10238 0.123155 0.955335 0.18027 0.818243C0.237385 0.681152 0.321079 0.556725 0.426523 0.452142C0.637306 0.24261 0.922439 0.125 1.21965 0.125C1.51686 0.125 1.80199 0.24261 2.01277 0.452142L11.6203 9.94714C11.7257 10.0517 11.8094 10.1762 11.8665 10.3132C11.9236 10.4503 11.953 10.5974 11.953 10.7459C11.953 10.8944 11.9236 11.0414 11.8665 11.1785C11.8094 11.3156 11.7257 11.4401 11.6203 11.5446Z" fill="#F8285A"/>
                    <path opacity="0.3" d="M2.01381 11.6247C1.79898 11.8426 1.50643 11.9661 1.20051 11.9682C0.894594 11.9703 0.600367 11.8508 0.382558 11.636C0.164749 11.4212 0.0411998 11.1286 0.03909 10.8227C0.0369802 10.5168 0.156482 10.2226 0.371308 10.0047L9.97881 0.374746C10.1936 0.156937 10.4862 0.0333873 10.7921 0.0312775C11.098 0.0291677 11.3922 0.14867 11.6101 0.363495C11.8279 0.578321 11.9514 0.870872 11.9535 1.17679C11.9556 1.48271 11.8361 1.77694 11.6213 1.99475L2.01381 11.6247Z" fill="#F8285A"/>
                </svg>`;
const spinner = '<span class="spinner-border spinner-border-sm tbr_text--primary" role="status" aria-hidden="true"></span>';
const checkListSvg = `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6637 5.93009C22.1121 6.37854 22.1121 7.10562 21.6637 7.55406L11.1373 18.0804C10.6889 18.5288 9.96182 18.5288 9.51337 18.0804L2.33634 10.9033C1.88789 10.4549 1.88789 9.72782 2.33634 9.27937C2.78479 8.83092 3.51187 8.83092 3.96031 9.27937L10.3254 15.6444L20.0397 5.93009C20.4881 5.48164 21.2152 5.48164 21.6637 5.93009Z" fill="#F8285A"/>
                    </svg>`;
const onclickSubmitAttr = "submit({el:this})";
const onclickRemoveAttr = "deleteVariant({el:this})";
const modalDelete = $("#tbr_modal_delete");

$(function () {
    activeSidebarTree({ id: "#sidebar-product-all" });

    // Listen photo change
    $(document).on('change', 'input[name="image"]', function(){
        let file = $(this)[0].files[0];
        let url = URL.createObjectURL(file);
        let img = $(this).siblings("img");
        let removeBtn = $(this).siblings(".tbr_remove_upload");
        img.fadeIn().attr('src', url);
        img.tooltip('dispose');
        img.tooltip({
            title: `<img width='300' src='${url}' />`,
            html: true,
            trigger: "hover focus",
            placement: "right",
            customClass: "tbr_tooltip--mw-fit",
        });
        showElement({el: removeBtn})
        ensureReadySubmit({ tr: $(this).parents("tr") });
    });

    // Listen input name change
    $(document).on(
        "input",
        'input[name="name"]',
        $.debounce(1000, function () {
            let val = $(this).val();
            if(val.length > 0){
                checkVariantName({name: val, el: $(this)});
            }
            else{
                let tr = $(this).parents("tr");
                setButtonLoading({ el: $(tr).find(".tbr_button--variant") });
            }
        })
    );

    $(document).on(
        "select2:select",
        'select[name="unit"]',
        $.debounce(1000, function () {
            ensureReadySubmit({ tr: $(this).parents("tr") });
        })
    );

    // Listen button hover
    $(document)
        .on("mouseenter", ".tbr_button--variant", function () {
            $(this).attr("onclick", onclickRemoveAttr);
            $(this).html(crossSvg);
        })
        .on("mouseleave", ".tbr_button--variant", function () {
            if ($(this).data("loading")) {
                setButtonLoading({ el: this });
            } else {
                setButtonCross({ el: this });
            }
        });
});

function checkVariantName({name, el}){
    $.ajax({
        url: urlCheckVariant,
        type: "POST",
        data: {
            name: name
        },
        success: function (res) {
            let isNameUsed = res.can_restore;
            if (isNameUsed) {
                let modalConfirmation = $("#tbr_modal_confirmation_variant");
                modalConfirmation.modal("show");
                modalConfirmation.find("#tbr_confirm").off('click').on('click', function(){
                    let data = res.data;
                    let tr = $(el).parents("tr");
                    let inputName = tr.find('input[name="name"]');
                    let inputUnit = tr.find('select[name="unit"]');
                    tr.data('variant-id', data.id);
                    inputName.val(data.name);
                    inputUnit.val(data.unit_id).trigger('change');
                    modalConfirmation.modal('hide');
                    ensureReadySubmit({ tr: $(el).parents("tr") });
                });
                modalConfirmation.find("#tbr_cancel").off('click').on('click', function(){
                    modalConfirmation.modal('hide');
                    ensureReadySubmit({ tr: $(el).parents("tr") });
                });
            } else {
                ensureReadySubmit({ tr: $(el).parents("tr") });
            }
        },
        error: function (xhr, status, error) {
            showToastError({ xhr: xhr });
        },
    });
}

function addVariant() {
    variantParent.append(generateTemplateVariant());
    variantParent.find("select").select2();
    showHideEmpty();
    $(`#upload--${indexDynamicForm}`).tooltip();
    $(`#delete-photo--${indexDynamicForm}`).tooltip();
    indexDynamicForm++;
}

function deleteVariant({ el }) {
    let urlDelete = $(el).data('url-delete');
    let tr = $(el).parents('tr');
    let inputName = tr.find('input[name="name"]');
    let inputUnit = tr.find('select[name="unit"]');

    if (typeof urlDelete != "undefined") {
        modalDelete.modal('show');
        modalDelete.off('shown.bs.modal').on('shown.bs.modal', function () {
            modalDelete.find("#tbr_confirm_delete").off('click').on('click', function(){
                let buttonConfirm = $(this);
                let buttonText = buttonConfirm.html();
                $.ajax({
                    url: urlDelete,
                    type: "DELETE",
                    beforeSend: function () {
                        buttonConfirm.attr("disabled", true);
                        buttonConfirm.html(
                                `Memproses <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                        );
                        setButtonLoading({ el: el });
                        inputName.attr("disabled", true);
                        inputUnit.attr("disabled", true);
                        $(el).attr("disabled", true);
                    },
                    success: function (res) {
                        $(el).parents("tr").remove();
                        showHideEmpty();
                        showSuccessToast({message: res?.message ?? "Success"});
                    },
                    error: function (xhr, status, error) {
                        setButtonCross({ el: el });
                        showToastError({ xhr: xhr });
                    },
                    complete: function () {
                        buttonConfirm.attr("disabled", false);
                        buttonConfirm.html(buttonText);
                        $(el).attr("disabled", false);
                        $(el).data("loading", false);
                        inputName.attr("disabled", false);
                        inputUnit.attr("disabled", false);
                        modalDelete.modal('hide');
                    },
                });
            });
        });
    }
    else {
        $(el).parents("tr").remove();
        showHideEmpty();
    }
}


function submit({ el, product_variant_id, image, name, unit_id }) {
    let formData = new FormData();
    formData.append('product_id', productId)
    if(image){
        formData.append("image", image);
    }
    if(product_variant_id){
        formData.append("product_variant_id", product_variant_id);
    }
    formData.append("name", name);
    formData.append("unit_id", unit_id);
    $.ajax({
        url: urlStore,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            setButtonLoading({ el: el });
        },
        success: function (res) {
            setButtonCheckList({ el: el });
            setTimeout(() => {
                setButtonCross({ el: el });
            }, 3000);
            $(el).parents("tr").data("variant-id", res.id);
            $(el).data("url-delete", res.url_delete);
            $(el).parents("tr").find('input[name="image"]').val("");
            $(el)
                .parents("tr")
                .find(".tbr_remove_upload")
                .attr(
                    "onclick",
                    `deletePhoto({el: this, url: '${res.url_remove_photo}'})`
                );
        },
        error: function (xhr, status, error) {
            showToastError({ xhr: xhr });
        },
        complete: function(){
            $(el).data("loading", false);
        }
    });
}

function ensureReadySubmit({ tr }) {
    let inputPhoto = tr.find('input[name="image"]');
    let inputName = tr.find('input[name="name"]').val() ?? "";
    let inputUnit = tr.find('select[name="unit"]').val() ?? "";
    let button = tr.find("button");

    let image = inputPhoto[0].files[0] ?? null;
    let product_variant_id = tr.data('variant-id');
    if(inputName.length > 0 && inputUnit.length > 0){
        submit({ el: button, product_variant_id: product_variant_id, image: image, name: inputName, unit_id: inputUnit });
    } else {
        setButtonLoading({ el: button });
    }
}

function generateTemplateVariant() {
    let options = "";
    units.forEach((unit) => {
        options += `<option value="${unit.id}">${unit.name}</option>`;
    });
    return `
        <tr>
            <td class="d-flex align-items-center gap-2">
                <img src="${galleryPng}" alt="" class="tbr_img--sm">
                <label
                    class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-success rounded-circle"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Unggah foto"
                    data-ajax-disabled="true"
                    id="upload--${indexDynamicForm}"
                    for="image--${indexDynamicForm}"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z" fill="#17C653"/>
                        <path d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z" fill="#17C653"/>
                        <path d="M11.5275 12.47L9.5275 10.47C9.5175 10.46 9.5075 10.46 9.5075 10.45C9.4475 10.39 9.3675 10.34 9.2875 10.3C9.2775 10.3 9.2775 10.3 9.2675 10.3C9.1875 10.27 9.1075 10.26 9.0275 10.25C8.9975 10.25 8.9775 10.25 8.9475 10.25C8.8875 10.25 8.8175 10.27 8.7575 10.29C8.7275 10.3 8.7075 10.31 8.6875 10.32C8.6075 10.36 8.5275 10.4 8.4675 10.47L6.4675 12.47C6.1775 12.76 6.1775 13.24 6.4675 13.53C6.7575 13.82 7.2375 13.82 7.5275 13.53L8.2475 12.81V17C8.2475 17.41 8.5875 17.75 8.9975 17.75C9.4075 17.75 9.7475 17.41 9.7475 17V12.81L10.4675 13.53C10.6175 13.68 10.8075 13.75 10.9975 13.75C11.1875 13.75 11.3775 13.68 11.5275 13.53C11.8175 13.24 11.8175 12.76 11.5275 12.47Z" fill="#17C653"/>
                    </svg>
                </label>
                <span
                    class='btn tbr_btn tbr_btn--icon sm tbr_btn--light-primary rounded-circle tbr_remove_upload d-none'
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Hapus foto"
                    id="delete-photo--${indexDynamicForm}"
                    onclick="deletePhoto({el: this, url: ''})"
                >
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M1.8382 15.572L0.324255 14.058C0.221787 13.9604 0.140212 13.8429 0.0844757 13.7128C0.028739 13.5827 0 13.4426 0 13.3011C0 13.1595 0.028739 13.0194 0.0844757 12.8893C0.140212 12.7592 0.221787 12.6417 0.324255 12.5441L12.5439 0.324258C12.6416 0.221789 12.759 0.140214 12.8892 0.0844767C13.0193 0.0287394 13.1594 0 13.3009 0C13.4425 0 13.5825 0.0287394 13.7127 0.0844767C13.8428 0.140214 13.9602 0.221789 14.0579 0.324258L15.5718 1.83822C15.6743 1.93588 15.7559 2.05333 15.8116 2.18345C15.8673 2.31357 15.8961 2.45365 15.8961 2.5952C15.8961 2.73675 15.8673 2.87683 15.8116 3.00695C15.7559 3.13707 15.6743 3.25452 15.5718 3.35218L3.35214 15.572C3.25464 15.6748 3.13725 15.7566 3.00711 15.8125C2.87697 15.8684 2.73681 15.8972 2.59517 15.8972C2.45353 15.8972 2.31337 15.8684 2.18323 15.8125C2.05309 15.7566 1.9357 15.6748 1.8382 15.572Z" fill="#DB0916"/>
                        <path d="M15.6734 14.058L14.1594 15.572C14.0618 15.6745 13.9443 15.7561 13.8142 15.8118C13.6841 15.8675 13.544 15.8963 13.4025 15.8963C13.2609 15.8963 13.1208 15.8675 12.9907 15.8118C12.8606 15.7561 12.7432 15.6745 12.6455 15.572L0.425817 3.35218C0.323349 3.25452 0.241775 3.13707 0.186038 3.00695C0.130302 2.87683 0.101563 2.73675 0.101562 2.5952C0.101563 2.45365 0.130302 2.31357 0.186038 2.18345C0.241775 2.05333 0.323349 1.93588 0.425817 1.83822L1.93976 0.324258C2.03742 0.221789 2.15487 0.140214 2.28498 0.0844767C2.4151 0.0287394 2.55518 0 2.69673 0C2.83828 0 2.97836 0.0287394 3.10848 0.0844767C3.2386 0.140214 3.35604 0.221789 3.4537 0.324258L15.6734 12.5441C15.7761 12.6416 15.858 12.759 15.9139 12.8891C15.9698 13.0193 15.9986 13.1594 15.9986 13.3011C15.9986 13.4427 15.9698 13.5829 15.9139 13.713C15.858 13.8432 15.7761 13.9605 15.6734 14.058Z" fill="#DB0916"/>
                    </svg>
                </span>
                <input type="file" name="image" id="image--${indexDynamicForm}" accept="image/*" hidden>
            </td>
            <td>
                <input type="text" class="tbr_form form-control md" name="name"/>
            </td>
            <td>
                <select name="unit" class="tbr_form form-control form-select form-select-solid" id="" data-control="select2">
                    <option value="init" selected disabled>Pilih satuan</option>
                    ${options}
                </select>
            </td>
            <td>
                <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary sm mx-auto tbr_button--variant" anim="ripple" onclick="" data-loading="true">
                    ${spinner}
                </button>
            </td>
        </tr>
    `;
}

function showHideEmpty() {
    if (variantParent.children().length > 0) {
        hideElement({ el: emptyVariant });
    } else {
        showElement({ el: emptyVariant });
    }
}

function setButtonLoading({ el }) {
    let button = $(el);
    if (button.html() != spinner) {
        button.html(spinner);
        button.removeAttr("onclick");
        button.data("loading", true);
    }
}

function setButtonCheckList({ el }) {
    let button = $(el);
    if (button.html() != checkListSvg) {
        button.html(checkListSvg);
        button.removeAttr("onclick");
        button.data("loading", false);
    }
}

function setButtonCross({ el }) {
    let button = $(el);
    if (button.html() != crossSvg) {
        button.attr("onclick", onclickRemoveAttr);
        button.html(crossSvg);
    }
}

function showToastError({xhr}){
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

function deletePhoto({el, url}){
    let deleteButton = $(el);
    let tr = deleteButton.parents('tr');
    let actionButton = tr.find(".tbr_button--variant");
    let variantId = tr.data('variant-id');
    let inputImage = deleteButton.parents("td").find('input[name="image"]');
    let previewImage = deleteButton.parents("td").find("img");
    if(variantId){
        $.ajax({
            url: url,
            method: "POST",
            data: {
                _method: "DELETE",
            },
            beforeSend: function(){
                deleteButton.attr('disabled', true);
                setButtonLoading({ el: actionButton });
            },
            success: function (data) {
                inputImage.val("");
                previewImage.attr("src", galleryPng);
                hideElement({ el: deleteButton });
                setButtonCheckList({ el: actionButton });
            },
            error: function (xhr, status, error) {
                showToastError({ xhr });
            },
            complete: function(){
                deleteButton.attr('disabled', false);
                setButtonCross({ el: actionButton });
                actionButton.data("loading", false);
            }
        });
    }
    else{
        inputImage.val("");
        previewImage.attr("src", galleryPng);
        hideElement({el: deleteButton});
    }
}
