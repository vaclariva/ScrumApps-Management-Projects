function resendCode({ el, url, token }) {
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: token,
        },
        beforeSend: function () {
            hideElement({ el: $(el) });
            showElement({ el: $("#loader") });
        },
        success: function (response) {
            showElement({ el: $("#alert-success") });
            hideElement({ el: $("#alert-error") });
        },
        error: function (xhr, status, error) {
            let errorList =
                typeof xhr.responseJSON?.errors === "object"
                    ? xhr.responseJSON?.errors
                    : xhr.responseJSON?.message;
            errorCallback(errorList);
        },
        complete: function () {
            hideElement({ el: $("#loader") });
            showElement({ el: $(el) });
        },
    });
}

function successCallback() {
    let alertSuccess = $("#alert-success");
    showElement({ el: alertSuccess });

    let alertError = $("#alert-error");
    hideElement({ el: alertError });
}

function errorCallback(message) {
    let alertError = $("#alert-error");
    alertError.html(message);
    showElement({ el: alertError });

    let alertSuccess = $("#alert-success");
    hideElement({ el: alertSuccess });
}
