$(function () {
    const passwordMeterElement = document.getElementById(
        "kt_password_meter_control"
    );
    const passwordMeter = KTPasswordMeter.getInstance(passwordMeterElement);
    const cbWeakPassword = $("#ensure-weak-password");
    const inputPasswordEl = $('[name="password"]');
    const progressOneEl = $("#progress-1");
    inputPasswordEl.on("input", function () {
        let score = passwordMeter.getScore();
        if (score <= 40) {
            $("input[name='is_weak_password']").val(1);
            progressOneEl
                .removeClass("bg-active-success")
                .addClass("bg-active-danger");
            if (score > 0) {
                showElement({ el: cbWeakPassword });
            } else {
                hideElement({ el: cbWeakPassword });
            }
        } else {
            $("input[name='is_weak_password']").val(0);
            progressOneEl
                .addClass("bg-active-success")
                .removeClass("bg-active-danger");
            hideElement({ el: cbWeakPassword });
        }
    });
});
