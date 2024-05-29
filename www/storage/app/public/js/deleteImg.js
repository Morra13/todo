/**
 * Delete img
 */
function deleteImg() {
    let loc = window.location.pathname.split('/');
    if (loc[1] == 'change') {
        const blob = new Blob([""], {type: 'application/octet-stream'});
        const file = new File([blob], "delete");
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        document.querySelector('#chooseFile').files = dataTransfer.files;
    } else {
        document.getElementById('chooseFile').value = null
    }
    document.getElementById('img').src = window.location.origin + '/storage/uploads/defaultUploadImg.png';
}
