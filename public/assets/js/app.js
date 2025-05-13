/**
 * Mencegah input text pada firefox
 * @param {*} e
 */
function preventNonNumericalInput(e) {
    e = e || window.event;
    var charCode = typeof e.which == "undefined" ? e.keyCode : e.which;
    var charStr = String.fromCharCode(charCode);

    if (!charStr.match(/^[0-9]+$/)) e.preventDefault();
}

/**
 * Mencegah input text pada firefox ada komanya
 * @param {*} e
 */
function preventNonNumericalInputWithComa(e) {
    e = e || window.event;
    var charCode = typeof e.which == "undefined" ? e.keyCode : e.which;
    var charStr = String.fromCharCode(charCode);

    if (!charStr.match(/^[0-9,]+$/)) e.preventDefault();
}

/**
 * Removes the 'd-none' class from the specified element.
 *
 * @param {Object} el - The element to show.
 */
function showElement({ el }) {
    el.removeClass("d-none");
}

/**
 * Adds the 'd-none' class from the specified element.
 *
 * @param {Object} el - The element to show.
 */
function hideElement({ el }) {
    el.addClass("d-none");
}

/**
 * Listen search input for show hide button clear.
 *
 * @param {Object} el - The element to show.
 */
function onSearchInput({el, clearButtonId}) {
    let val = $(el).val();

    if(val === ""){
        hideElement({ el: $(el).siblings(".tbr_button-clear") });
    }
    else{
        showElement({ el: $(el).siblings(".tbr_button-clear") });
    }

    $(clearButtonId).off().on('click', function(){
        $(el).val("").trigger('keyup');
        hideElement({ el: $(el).siblings(".tbr_button-clear") });
    });
}

const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(number).replace(',00', '');
};

$(function () {
    /**
     * ...
     */
    $(document).on("keypress", "[type='number']", function (event) {
        preventNonNumericalInput(event);
    });

    /**
     * ...
     */
    $(document).on("keypress", "[type='number-with-coma']", function (event) {
        preventNonNumericalInputWithComa(event);
    });

    /* ======================================
    * Button ripple
    ====================================== */
    ("use strict");
    [].map.call(document.querySelectorAll("[anim='ripple']"), (el) => {
        el.addEventListener("click", (e) => {
            e = e.touches ? e.touches[0] : e;
            const r = el.getBoundingClientRect(),
                d = Math.sqrt(Math.pow(r.width, 2) + Math.pow(r.height, 2)) * 2;
            $(el).css("--s", "0");
            $(el).css("--o", "1");
            $(el).css("--t", "");
            $(el).css("--d", "");
            $(el).css("--x", "");
            $(el).css("--y", "");
            el.offsetTop;
            $(el).css("--s", "");
            $(el).css("--t", "1");
            $(el).css("--o", "0");
            $(el).css("--d", d);
            $(el).css("--x", e.clientX - r.left);
            $(el).css("--y", e.clientY - r.top);
        });
    });
});
