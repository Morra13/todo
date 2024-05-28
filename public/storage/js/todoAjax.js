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
