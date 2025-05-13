const provinceSelect = $("#province_id");
const regencySelect = $("#regency_id");
const regencyLoader = $("#regency-loader");
const districtSelect = $("#district_id");
const districtLoader = $("#district-loader");

$(function () {
    activeSidebarTree({id: "#sidebar-customer-partner"});
    // Refresh select
    regencySelect.val("").trigger("change");
    districtSelect.val("").trigger("change");

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
        beforeSend: function(){
            showElement({el: regencyLoader});
            clearRegency();
            clearDistrict();
        },
        success: function (regencies) {
            regencies.forEach((regency)=>{
                regencySelect.append(
                    `<option value="${regency.id}">${regency.name}</option>`
                );
            });
        },
        complete: function(){
            hideElement({el: regencyLoader});
            regencySelect.attr("disabled", false);
        }
    });
}

function getDistricts({ id }) {
    $.ajax({
        url: `/district/${id}`,
        type: "GET",
        beforeSend: function(){
            showElement({el: districtLoader});
            clearDistrict();
        },
        success: function (districts) {
            districts.forEach((district)=>{
                districtSelect.append(
                    `<option value="${district.id}">${district.name}</option>`
                );
            });
        },
        complete: function(){
            hideElement({el: districtLoader});
            districtSelect.attr("disabled", false);
        }
    });
}

function clearRegency(){
    regencySelect.attr("disabled", true);
    regencySelect.val("").trigger("change");
    regencySelect.find('option[value!=""]').remove();
}

function clearDistrict(){
    districtSelect.attr("disabled", true);
    districtSelect.val("").trigger("change");
    districtSelect.find('option[value!=""]').remove();
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
