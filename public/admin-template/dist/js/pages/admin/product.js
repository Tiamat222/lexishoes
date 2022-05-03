/* Default otion value */
var attributesOptions = '<option value="-">-</option>';

/* Main block for all attributes selects */
var mainBlock = $('.product-attributes');

/* Dropzone */
var dropZone = $('#drag-drop-area');

var i = 0;

var imageArr = '';

dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(){
    return false;
});

dropZone.on('drop', function(e) {
    let files = e.originalEvent.dataTransfer.files;
    sendFiles(files);
});

$('#file-input').change(function() {
    let files = this.files;
    sendFiles(files);
});

function sendFiles(files) {
    let data = new FormData();
    $(files).each(function(index, file) {
        data.append('images[]', file);
    });
    $.ajax({
        url: '/admin/catalog/products/download-images',
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        data: data,
        contentType: false,
        processData: false,
        success: function(resp) {
            console.log(resp);
            var respArray = resp.split(',');
            $(respArray).each(function(key, value) {
                if(value.indexOf("100-") !== -1) {
                    i++;
                    $('#media-items').append('\
                        <div class="image-block-' + i + '" style="border-left:4px solid green;background-color:#E5E5E5;height:50px;margin-bottom:5px;">\
                          <div style="float:left;height:50px;width:50px;margin:0px 10px 0px 3px;float:left">\
                          <img src="https://lexishoes.com.ua/' + value + '" style="width: 100%;height: 100%;object-fit: contain;">\
                          </div>\
                          <div class="message" style="float:left;">\
                            Изображение было успешно загружено\
                          </div>\
                          <div class="" style="float:right;height:25px;width:300px;margin-top:15px;">\
                            <div class="form-check" style="float:left;margin-right:10px;">\
                              <input class="form-check-input" type="radio" name="radio" value="' + i + '" onchange="selectMainImage(' + i + ')">\
                              <label class="form-check-label">Сделать изображение главным</label>\
                            </div>\
                            <a href="#" class="close-thik" id="image-block-' + i + '" onclick="removeBlock(' + i + '); event.preventDefault()"></a>\
                          </div>\
                        </div>\
                    ');
                    if(imageArr !== '') {
                        var pathToImage = value.split('/100-');
                        imageArr += '|' + pathToImage.join('/');
                        applyToInput();
                    } else {
                        selectMainImage();
                    }
                }
            });
        }
    });
};

function removeBlock(key)
{
    var blockClass = $('.image-block-' + key);
    blockClass.remove();
    var checkedRadioId = $('input[name=radio]:checked').val();
    selectMainImage(checkedRadioId);
}

function selectMainImage(i)
{
    if(i !== undefined) {
        var img = $('.image-block-' + i + ' img');
        var imgSrc = img.attr('src');
        var imgSrc = pathToImg(imgSrc);
    } else {
        imgSrc = '';
    }

    var allImg = getAllImages();
    imageArr = '';
    $.each(allImg, function(index, value){
        if(value === imgSrc) {
            if(allImg.length - 1 !== index) {
                imageArr += 'main:' + value + '|';
            } else {
                imageArr += 'main:' + value;
            }
        } else {
            if(allImg.length - 1 !== index) {
                imageArr += value + '|';
            } else {
                imageArr += value;
            }
        }
    });
    applyToInput();
}

function getAllImages()
{
    var imgArr = [];
    var images = $('#media-items img');
    images.each(function(index, value){
        var imgSrc = value.getAttribute('src');
        var imgSrc = pathToImg(imgSrc);
        imgArr.push(imgSrc);
    });
    return imgArr;
}

function pathToImg(imgSrc)
{
    var imgSrc = imgSrc.split('https://lexishoes.com.ua/');
    var pathToImage = imgSrc[1].split('/100-');
    var mainImage = pathToImage.join('/');
    return mainImage;
}

function applyToInput()
{
    var imagesInput = $('#product-images');
    return imagesInput.val('').val(imageArr);
}







//////////////////////////////////////////////////////////////////////////////

















//////////////////////////////////////////////////////////////////////////////








/* Slug output */
$('#name').on('keyup', function(e){
    e.preventDefault();
    var nameValue = $(this).val();
    $.ajax({
        url: '/admin/catalog/products/create-slug',
        type: "POST",
        data: {nameValue:nameValue},
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        success: function(resp){
            $('#slug').val(resp['slug']);
        }
    });
});

/* Get all attributes */
$.ajax({
    url: '/admin/catalog/attributes/list',
    type: "GET",
    success: function(resp){
        $.each(resp, function(index, value) {
            attributesOptions += '<option value="' + value['id'] + '">' + value['name'] + '</option>';
        });
    }
});

$('#add-attribute').on('click', function(){
    if(mainBlock.children().length === 0) {
        mainBlock.append(htmlBlock(attributesOptions, 1));
    } else {
        var lastChild = mainBlock.children().get(-1);
        var childId = lastChild.getAttribute('id').split('-')[1];
        var newId = parseInt(childId) + 1;
        mainBlock.append(htmlBlock(attributesOptions, newId));
    }

    var closeLinks = ($('.product-attributes a'));
    $.each(closeLinks, function(index, value) {
        var linkId = value.getAttribute('id');
        $('#' + linkId).on('click', function(e){
            e.preventDefault();
            var subId = getSubId('#' + linkId);
            destroyBlock(subId);
        });
    });
 
    var selectCollection = $('.product-attributes .action-attributes select');

    $.each(selectCollection, function(index, value) {
        var id = value.getAttribute('id');
        var selectId = '#' + id;
        $(document).on('change', selectId, function() {
            var subId = getSubId(selectId);
            var attributeId = $(selectId).val();
            $('#attribute-value-' + subId).html('<option value="-">-</option>');

            $.ajax({
                url: '/admin/catalog/attributes/values',
                type: "POST",
                data: {attributeId:attributeId},
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function(resp){
                    $.each(resp, function(index, value) {
                        $('#attribute-value-' + subId).append('<option value="' + index + '">' + value + '</option>');
                    });
                }
            });   
        });
    });
});

/* HTML block with selects */
function htmlBlock(attributesOptions, newId)
{
    return '<div class="row" id="row-' + newId + '">\
              <div class="col-12 col-sm-6">\
                <div class="form-group action-attributes">\
                  <label>Харктеристики</label>\
                  <select class="custom-select" name="attribute" id="attribute-' + newId + '">'
                    + attributesOptions +
                  '</select>\
                </div>\
              </div>\
              <div class="col-12 col-sm-5">\
                <div class="form-group">\
                  <label>Значение</label>\
                    <select style="float:left;" class="custom-select" name="attribute-value" id="attribute-value-' + newId + '">\
                      <option value="-" selected>-</option>\
                    </select>\
                </div>\
              </div>\
              <a href="#" type="submit" id="rowClose-' + newId + '" class="btn btn-danger" style="height:40px;margin-top:31px;"><i class="fa fa-times" aria-hidden="true"></i></a>\
            </div>'
}

/* Get int id */
function getSubId(selectId)
{
    return selectId.split('-')[1];
}

/* Destroy block with selects */
function destroyBlock(subId)
{
    $('#row-' + subId).remove();   
}

function displayAlert()
{
    var messageBlock = '\
      <div class="alert callout callout-danger" style="background:#FF8080;">\
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
        <h5><i class="icon fas fa-ban"></i>Ошибка!</h5>\
        Один или несколько атрибутов (или их значений) не были выбраны\
      </div>\
    ';
    $('#custom-content-below-main div:eq(0)').after(messageBlock);
}

/* Write attributes id's with values id's in hidden input */
$('#save-button').on('click', function(e){
    var selectedOptions = $('.product-attributes select');
    var total = selectedOptions.length;
    var summary = '';
    $.each(selectedOptions, function(index, value) {
        var id = value.getAttribute('id');
        if($('#' + id).val() === '-') {
            displayAlert();
            return false;
        }
        if(index % 2 !== 0) {
            if(index !== selectedOptions.length - 1) {
                summary += $('#' + id).val() + ',';
            } else {
                summary += $('#' + id).val();
            }
        }
    });
    $('#select-attributes').val(summary);
});


$('#price, #discount').on('keyup', function(){
    $('.prices-danger').remove();
    var summary = $('#price').val() - $('#discount').val();
    if(summary <= 0 && $('#price').val() !== '') {
      $('#summary').html('');
      $('#summary_price').val('');
      var messageBlock = '\
        <div class="alert callout callout-danger prices-danger" style="background:#FF8080;margin-top:7px;">\
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
          <h5><i class="icon fas fa-ban"></i>Ошибка!</h5>\
          Итоговая стоимость товара не может быть меньше или равна 0\
        </div>\
      ';
      $('#custom-content-below-profile').prepend(messageBlock);
    } else {
        $('#summary').html('<b>' + summary + '</b>');
        $('#summary_price').val(summary);
    }
});








