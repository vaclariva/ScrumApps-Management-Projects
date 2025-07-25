$(function () {
    activeSidebarTree({ id: "#sidebar-backlogs" });

    // Initialize Bootstrap collapse for all collapse elements
    $('.collapse').each(function() {
        $(this).collapse({
            toggle: false
        });
    });

    // Handle collapse animation for grouped backlogs
    $('.collapsible').on('click', function(e) {
        e.preventDefault();
        const target = $(this).data('bs-target');
        const $target = $(target);

        if ($target.hasClass('show')) {
            $target.collapse('hide');
        } else {
            $target.collapse('show');
        }
    });
});
