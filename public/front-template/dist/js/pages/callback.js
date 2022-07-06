jQuery(function($) {

    let nameResult = true;
    let phoneResult = true;
    
    $('#send-callback').on('click', function(e){
        if($.trim($('.customer-name').val()).length == 0 || !$('.customer-name').val().match(/^[A-Za-zА-яЁё0-9-\s]+$/)) {
            nameResult = false;
            $('#name-input').removeClass('form-group').addClass('form-group has-error');
            if($('#name-error').html() == '') {
                $('#name-error').css({'margin-bottom':'10px'});
                $('#name-error').append('<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#a94442;"></i> <span style="color:#a94442;">Вы не ввели имя / в имени содержатся запрещенные символы</span>');
            }
        } else {
            if($('#name-error').html() !== '') {
                $('#name-input').removeClass('form-group has-error').addClass('form-group');
                $('#name-error').css({'margin-bottom':'0px'}).empty();
            }
            nameResult = true;
        }

        if(!$('.customer-phone').val().match(/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/)) {
            phoneResult = false;
            $('#phone-input').removeClass('form-group').addClass('form-group has-error');
            if($('#phone-error').html() == '') {
                $('#phone-error').css({'margin-bottom':'10px'});
                $('#phone-error').append('<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#a94442;"></i> <span style="color:#a94442;">Вы не ввели телефон / номер телефона указан в некорректном формате</span>');
            }
        } else {
            if($('#phone-error').html() !== '') {
                $('#phone-input').removeClass('form-group has-error').addClass('form-group');
                $('#phone-error').css({'margin-bottom':'0px'}).empty();
            }
            phoneResult = true;
        }

        if(nameResult == false || phoneResult == false) {
            return false;
        }
    });

    $('.customer-name, .customer-phone').on('keyup', function() {
        if(!$.trim($('.customer-name').val()).length == 0 && $('.customer-name').val().match(/^[A-Za-zА-яЁё0-9-\s]+$/)) {
            $('#name-input').removeClass('form-group has-error').addClass('form-group');
            $('#name-error').css({'margin-bottom':'0px'}).empty();
        }

        if($('.customer-phone').val().match(/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/)) {
            $('#phone-input').removeClass('form-group has-error').addClass('form-group');
            $('#phone-error').css({'margin-bottom':'0px'}).empty();
        }
    });
    
});