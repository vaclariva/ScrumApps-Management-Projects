$(document).ready(function() {
    $('body').on('click', '.edit-team', function(e) {
        e.preventDefault();

        const teamId = $(this).data('id');
        const userId = $(this).data('user-id');
        const teamRole = $(this).data('role');

        $('#updateTeamForm').attr('action', '/teams/' + teamId);

        $('#teamId').val(teamId);
        $('#team_user').val(userId).trigger('change');
        $('#team_role').val(teamRole).trigger('change');;

        $('#modal_edit_teams').modal('show');
    });

    $('body').on('click', '#updateTeamForm button[type="button"]', function(e) {
        e.preventDefault();

        var form = $('#updateTeamForm');
        var formData = form.serialize();
        console.log(formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-HTTP-Method-Override', 'PATCH');
            },
            success: function(response) {
                alert(response.message);
                window.location.href = response.redirect;
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan saat mengupdate data tim');
            }
        });
    });
});
