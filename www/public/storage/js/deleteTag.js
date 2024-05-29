function deleteTag (btn) {
    let wrapper = document.querySelector('#wrapper');
    let div = document.querySelector('#' + btn.value)
    wrapper.removeChild(div);
}
