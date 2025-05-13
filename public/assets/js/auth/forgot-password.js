function successCallback() {
    showElement({ el: $("#alert-success") });
    hideElement({ el: $("#alert-error") });
}

function errorCallback(message) {
    hideElement({ el: $("#alert-success") });
    showElement({ el: $("#alert-error") });

    $("#alert-error").html(message);
}
