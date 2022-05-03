$('.import-select').on('change', function() {
    $('.callout-info').empty();
    var currentOption = $(this).val();
    switch(currentOption) {
        case 'categories':
            $('.callout-info').append('\
            name*<br>\
            slug*<br>\
            description<br>\
            category_image<br>\
            is_active<br>\
            category_id<br>\
            meta_title<br>\
            meta_description<br>\
            meta_keywords<br>\
            ');
            break;
        case 'suppliers':
            $('.callout-info').append('\
            name*<br>\
            description<br>\
            ');
            break;
    }
});