$('#input-name').on('keyup', function(e){
    e.preventDefault();
    var nameValue = $(this).val();
    $.ajax({
        url: '/admin/catalog/categories/create-slug',
        type: "POST",
        data: {nameValue:nameValue},
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: function(resp){
            $('#input-slug').val(resp['slug']);
        }
    });
});

$('.in-list-del').each(function(i, elem){
    $(this).on('click', function(){
        return confirm('Внимание! При удалении категории также будут удалены все категории-потомки, а товары из них будут перемещены в раздел "Черновики"');
    });
});