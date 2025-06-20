$(document).on('focus', '.date', function () {
    console.log('Focus terpicu untuk:', this.id);
    if (!$(this).data('td-init')) {
        new tempusDominus.TempusDominus(this, {
            display: {
                components: {
                    clock: true,
                    seconds: false,
                    useTwentyfourHour: true
                },
                buttons: {
                    today: true,
                    close: true,
                    clear: true
                }
            },
            localization: {
                format: 'dd MMMM yyyy, HH:mm',
                locale: 'id'
            }
        });
        $(this).data('td-init', true);
    }
});
