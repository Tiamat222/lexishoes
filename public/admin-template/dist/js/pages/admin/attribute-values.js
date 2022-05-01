jQuery(document).ready(function($) {
    let attributeName = $("#attribute-value option:selected").text();
    if(attributeName == 'Цвет верха' || attributeName == 'Цвет подошвы') {
        $('#input-name').prop('disabled', false);
        $('#input-name').removeClass('form-control').addClass('form-control my-colorpicker1 colorpicker-element');
        addColorPicker();
    } else if(attributeName == '-') {
        $('#input-name').prop('disabled', true);
    } else {
        $('#input-name').prop('disabled', false);
    }

    $('#attribute-value').on('change', function(e) {
        e.preventDefault();
        let attrName = $("#attribute-value option:selected").text();
        $('#attribute-type').prop('value', attrName);
        switch(attrName) {
            case '-':
                $('#input-name').val('');
                $('#input-name').prop('disabled', true);
                break;
            case 'Цвет верха':
            case 'Цвет подошвы':
                $('#input-name').prop('disabled', false);
                $('#input-name').removeClass('form-control').addClass('form-control my-colorpicker1 colorpicker-element');
                addColorPicker();
                break;
            default:
                $('#input-name').prop('disabled', false);
                removeColorPicker();
                $('#input-name').removeClass('form-control my-colorpicker1 colorpicker-element').addClass('form-control');
        }
    });

    function addColorPicker()
    {
        $('.my-colorpicker1').colorpicker();
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        });
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    }

    function removeColorPicker()
    {
        $('.my-colorpicker1').colorpicker('destroy');
    }

});