/**
 * Toggle password visibility
 * IMPORTANT => Find example in file login.blade.php
 */
$(".show-password").on("click", function(event) {
    event.preventDefault();
    $(this).find("#open-eye").toggle();
    $(this).find("#close-eye").toggle();

    var input = $(this).siblings("input");
    input.attr("type") === "password" ? input.attr("type","text") : input.attr("type","password");
});