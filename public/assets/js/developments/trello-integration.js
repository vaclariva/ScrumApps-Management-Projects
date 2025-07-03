$(document).ready(function() {
    // Handle click pada tombol integrasi Trello
    $('#btn-integrate-trello').on('click', function() {
        const projectId = $(this).data('project-id');
        const button = $(this);
        const buttonText = $('#trello-btn-text');

        // Disable button dan ubah text
        button.prop('disabled', true);
        buttonText.text('Memproses...');

        // Kirim request ke backend
        $.ajax({
            url: '/developments/integrate-trello',
            method: 'POST',
            data: {
                project_id: projectId,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.already_integrated) {
                    // Jika sudah terintegrasi, ubah tombol menjadi "Lihat di Trello"
                    button.removeClass('tbr_btn--success').addClass('tbr_btn--info');
                    buttonText.text('Lihat di Trello');
                    button.prop('disabled', false);
                    button.off('click').on('click', function() {
                        window.open(response.board_url, '_blank');
                    });

                    // Tampilkan notifikasi
                    toastr.success(response.message);
                    // Redirect langsung ke board Trello
                    window.open(response.board_url, '_blank');
                } else {
                    // Jika baru terintegrasi, ubah tombol menjadi "Lihat di Trello"
                    button.removeClass('tbr_btn--success').addClass('tbr_btn--info');
                    buttonText.text('Lihat di Trello');
                    button.prop('disabled', false);
                    button.off('click').on('click', function() {
                        window.open(response.board_url, '_blank');
                    });

                    // Tampilkan notifikasi sukses
                    toastr.success(response.message);
                    // Redirect langsung ke board Trello
                    window.open(response.board_url, '_blank');
                }
            },
            error: function(xhr) {
                // Re-enable button dan kembalikan text
                button.prop('disabled', false);
                buttonText.text('Integrasikan dengan Trello');

                // Tampilkan error
                let errorMessage = 'Terjadi kesalahan saat integrasi dengan Trello';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                toastr.error(errorMessage);
            }
        });
    });
});
