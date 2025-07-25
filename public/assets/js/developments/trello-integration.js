$(document).ready(function() {
    $('#btn-integrate-trello').on('click', function() {
        const projectId = $(this).data('project-id');
        const button = $(this);
        const buttonText = $('#trello-btn-text');

        button.prop('disabled', true);
        buttonText.text('Memproses...');

        $.ajax({
            url: '/developments/integrate-trello',
            method: 'POST',
            data: {
                project_id: projectId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.already_integrated) {
                    button.removeClass('tbr_btn--success').addClass('tbr_btn--info');
                    buttonText.text('Lihat di Trello');
                    button.prop('disabled', false);
                    button.off('click').on('click', function() {
                        window.open(response.board_url, '_blank');
                    });

                    toastr.success(response.message);
                    window.open(response.board_url, '_blank');
                } else {
                    button.removeClass('tbr_btn--success').addClass('tbr_btn--info');
                    buttonText.text('Lihat di Trello');
                    button.prop('disabled', false);
                    button.off('click').on('click', function() {
                        window.open(response.board_url, '_blank');
                    });
                    toastr.success(response.message);
                    window.open(response.board_url, '_blank');
                }
            },
            error: function(xhr) {
                button.prop('disabled', false);
                buttonText.text('Integrasikan dengan Trello');

                let errorMessage = 'Terjadi kesalahan saat integrasi dengan Trello';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                toastr.error(errorMessage);
            }
        });
    });
});
