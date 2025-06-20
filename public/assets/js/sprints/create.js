const editors = {};

$(document).ready(function() {
    $('input[name="status"]').on('change', function () {
        if ($(this).is(':checked')) {
            $('.result-sprint').removeClass('d-none');
        } else {
            $('.result-sprint').addClass('d-none');
        }
    });
});

function submitAjax({ el }) {
    let form = $(el).closest("form");

    $.each(editors, function (id, editor) {
        const data = editor.getData();
        $(`#${id}`).val(data);
        console.log(`${id} ->`, data);
    });

    $(el).find(".loader").removeClass("d-none");
    $(el).attr("disabled", true);
    $(el).attr("type", "submit");

    setTimeout(() => {
        form.removeAttr("data-success-callback").trigger("submit");
    }, 100);
}

function completeCallback() {
    let buttons = $(".card-footer").find(".tbr_btn");
    buttons.removeAttr("disabled").removeAttr("type");
}

function successCallback() {
    window.location.href = "";
}
