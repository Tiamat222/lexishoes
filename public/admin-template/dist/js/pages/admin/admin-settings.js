let permId = '';



$(document).ready(function(){

    $('ul.admin-perms li').each(function(key, value) {
        let liId = $(this).attr('id');
        liId = liId.replace('li-', '');
        if(key !== $('ul.admin-perms li').length - 1) {
            permId += liId + ',';
        } else {
            permId += liId;
        }
        addIdInput();
    });



    $('#add-permission').on('click', function(){
        let selectedText = $("select option:selected").text();
        let selectedId = $("select option:selected").attr('value');
        if(selectedText !== '' && selectedText !== undefined) {
            $('.selected ul').append('\
                <li style="list-style-type: none;" id="li-' + selectedId + '">' + selectedText + '\
                <a href="#" class="close" aria-label="Close" onclick="destroyElem(' + selectedId + '); event.preventDefault()">\
                    <span aria-hidden="true">x</span>\
                </a></li>');
                if(permId === '') {
                    permId += selectedId;
                } else {
                    permId += ',' + selectedId;
                }
                addIdInput();
            $("#" + selectedId).remove();
        }

    });
});

function destroyElem(selectId)
{
    let liToDestroy = $('#li-' + selectId);
    let liText = liToDestroy.text().replace('x', '').trim();
    $('#li-' + selectId).remove();
    removeId(selectId);
    addSelect(selectId, liText);
}

function addSelect(id, text)
{
    return $("select").append('<option id="' + id + '" value="' + id + '">' + text + '</option>');
}

function removeId(selectId)
{
    permId.indexOf(',' + selectId) >= 0 ? permId = permId.replace(',' + selectId, '') : permId = permId.replace(selectId, '');
    permId.indexOf(',') == 0 ? permId = permId.substring(1) : permId;
    addIdInput();
}

function addIdInput()
{
    $('#admin-permissions').val('').val(permId);
}