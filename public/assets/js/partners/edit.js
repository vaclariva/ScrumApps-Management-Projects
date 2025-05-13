const provinceSelect = $("#province_id");
const regencySelect = $("#regency_id");
const regencyLoader = $("#regency-loader");
const districtSelect = $("#district_id");
const districtLoader = $("#district-loader");

$(function () {
    activeSidebarTree({ id: "#sidebar-customer-partner" });

    // Listen select regency
    provinceSelect.on("select2:select", function () {
        let id = $(this).val();
        getRegencies({ id: id });
    });

    // Listen select regency
    regencySelect.on("select2:select", function () {
        let id = $(this).val();
        getDistricts({ id: id });
    });
});

function getRegencies({ id }) {
    $.ajax({
        url: `/regency/${id}`,
        type: "GET",
        beforeSend: function () {
            showElement({ el: regencyLoader });
            clearRegency();
            clearDistrict();
        },
        success: function (regencies) {
            regencies.forEach((regency) => {
                regencySelect.append(
                    `<option value="${regency.id}">${regency.name}</option>`
                );
            });
        },
        complete: function () {
            hideElement({ el: regencyLoader });
            regencySelect.attr("disabled", false);
        },
    });
}

function getDistricts({ id }) {
    $.ajax({
        url: `/district/${id}`,
        type: "GET",
        beforeSend: function () {
            showElement({ el: districtLoader });
            clearDistrict();
        },
        success: function (districts) {
            districts.forEach((district) => {
                console.log(district);
                districtSelect.append(
                    `<option value="${district.id}">${district.name}</option>`
                );
            });
        },
        complete: function () {
            hideElement({ el: districtLoader });
            districtSelect.attr("disabled", false);
        },
    });
}

function clearRegency() {
    regencySelect.attr("disabled", true);
    regencySelect.val("").trigger("change");
    regencySelect.find('option[value!=""]').remove();
}

function clearDistrict() {
    districtSelect.attr("disabled", true);
    districtSelect.val("").trigger("change");
    districtSelect.find('option[value!=""]').remove();
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
