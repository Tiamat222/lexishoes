$(document).ready(function() {
    /* Create slug */
    $('#title').on('keyup', function(e){
        e.preventDefault();
        let pageTitle = $(this).val();
        $.ajax({
            url: '/admin/catalog/pages/create-slug',
            type: "POST",
            data: {pageTitle:pageTitle},
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            success: function(resp){
                $('#slug').val(resp['slug']);
            }
        });
    });
});