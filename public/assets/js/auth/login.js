/*
 * countdown for throttle alert.
 */
if ($("#throttle-alert").length) {
    const DateTime = luxon.DateTime;
    const throttle_end = $("#throttle-alert").data("throttle-end");
    let countDownDate = DateTime.fromSQL(throttle_end).toMillis();

    setInterval(() => {
        let now = DateTime.now().toMillis();
        let distance = countDownDate - now;

        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        minutes < 10
            ? $("#minutes").html(`0${minutes}`)
            : $("#minutes").html(minutes);
        seconds < 10
            ? $("#seconds").html(`0${seconds}`)
            : $("#seconds").html(seconds);
        if (distance < 0) {
            $("#throttle-alert").remove();
        }
    }, 1000);
}

function errorCallback(message) {
    let alertError = $("#ajax-error");
    alertError.html(message);
    hideElement({ el: $(".tbr_alert--danger") });
    showElement({ el: alertError });
}
