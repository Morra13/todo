/**
 * Create "todo" by ajax
 *
 * @param url
 */
function todoAjax (url) {
    $('#formCreateTodo').submit(function (){
        let formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: url.value,
            data: formData,
            processData: false,
            contentType: false,
            success : function(response) {
                $('#wrapperForMain')[0].replaceWith($(response).children('#wrapperForMain')[0]) ;
                $('#shell').append(
                    "<div class=\"alert alert-success alert-dismissible fade show mt-5 text-center\" role=\"alert\">\n" +
                    "                            <strong>Список был успешно создан!!!</strong>\n" +
                    "                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>\n" +
                    "                        </div>"
                )
            }
        })
        return false;
    })
}

/**
 * Delete "todo" by ajax
 *
 * @param url
 */
function deleteTodoAjax (url) {
    $('#formDeleteTodo').click(function (e){
        let data = $(this).serialize();
        $.ajax({
            type: 'post',
            url: url.value,
            data: data,
            dataType: 'html',
            success : function(response) {
                $('#wrapper')[0].replaceWith($(response).children('.col-12').children('.col-9')[0]) ;
            }
        })
        return false;
    })
}
