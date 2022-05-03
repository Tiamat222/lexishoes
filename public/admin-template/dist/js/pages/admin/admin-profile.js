$(document).ready(function() {
    /* Compare passwords */
    $('#changePwd').attr('disabled', true);

    $('#newPwd, #confirmPwd').on('keyup', function(){
        var confirmwPwdVal = $('#confirmPwd').val();
        var newPwdVal = $('#newPwd').val();
    
        if(newPwdVal !== confirmwPwdVal || newPwdVal == '' || confirmwPwdVal == '') {
            $('#changePwd').attr('disabled', true);
            $('#newPwd').removeClass('form-control').addClass('form-control is-invalid');
            $('#confirmPwd').removeClass('form-control').addClass('form-control is-invalid');
        } else {
            $('#changePwd').attr('disabled', false);
            $('#newPwd').removeClass('form-control is-invalid').addClass('form-control is-valid');
            $('#confirmPwd').removeClass('form-control is-invalid').addClass('form-control is-valid');
        }
    });
    /* Show file name in input */
    $('#customFile').on('change', function(){
        var filename = $('input[type=file]').val().split('\\').pop();
        $('.custom-file-label').text(filename);
    });
});

