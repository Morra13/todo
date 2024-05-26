function addTag() {
    const wrapper = document.querySelector('#wrapper');
    const divTag = document.querySelector('#divTag_0');
    let count = document.querySelector('#count');
    let i = ((count.value * 1) + 1);
    let createBlock = document.createElement('div');

    createBlock.id = 'divTag_' + i;
    createBlock.classList = 'input-group mb-3';
    createBlock.innerHTML = divTag.innerHTML;
    createBlock.querySelector('#tag_0').name = 'tag_' + i;
    createBlock.querySelector('#buttonDeleteTag_0').classList.remove('d-none');
    createBlock.querySelector('#buttonDeleteTag_0').value = 'divTag_' + i;
    createBlock.querySelector('#buttonDeleteTag_0').id = 'buttonDeleteTag_' + i;
    createBlock.querySelector('#tag_0').setAttribute('id', 'tag_' + i);
    i++;
    count.value = i;

    wrapper.append(createBlock);
}
