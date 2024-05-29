function accessAjax (url) {
    $('#formAddAccess').submit(function (){
        let data = $(this).serialize();
        $.ajax({
            type: 'post',
            url: url.value,
            data: data,
            dataType: 'html',
            success : function(response) {
                $('#wrapper')[0].replaceWith($(response).children('#wrapper')[0]) ;
            }
        })
        return false;
    })
}
