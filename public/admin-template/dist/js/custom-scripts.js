$('#mass-actions').on('click', function() {
    if($(this).is(':checked')) {
        $('.odd input:checkbox').prop('checked', true);
    } else {
        $('.odd input:checkbox').prop('checked', false);
    }
});

$('#restore-all').on('click', function() {
    var ids = [];
    $('.odd input:checkbox:checked').each(function(){
        ids.push($(this).val());
    });
    if(ids.length !== 0) {
        $.ajax({
            url: '/admin/catalog/suppliers/restore-all',
            type: "POST",
            data: {ids:ids},
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            success: function(resp){
                window.location.href = "/admin/catalog/suppliers";
            },
            error: function(){
                alert(333);
            }
        });
    }
});

$('#delete-all').on('click', function() {
    var ids = [];
    $('.odd input:checkbox:checked').each(function(){
        ids.push($(this).val());
    });
    if(ids.length !== 0) {
        $.ajax({
            url: '/admin/catalog/suppliers/delete-all',
            type: "POST",
            data: {ids:ids},
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            success: function(resp){
                window.location.href = "/admin/catalog/suppliers/trash";
            },
            error: function(){
                alert(333);
            }
        });
    }
});

$('.meta-title, .meta-keywords, .meta-description').on('keyup', function(){
    switch(this.className) {
        case 'form-control meta-title':
            $('.meta-title-span').text(70 - $(this).val().length);
            break;
        case 'form-control meta-keywords':
            $('.meta-keywords-span').text(255 - $(this).val().length);
            break;
        case 'form-control meta-description':
            $('.meta-description-span').text(160 - $(this).val().length);
            break;
    }
});