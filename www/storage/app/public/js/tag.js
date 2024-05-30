/**
 * Add tag block
 */
function addTag() {
    const wrapper = document.querySelector('#wrapperTag');
    const divTag = document.querySelector('#divTag');
    let count = document.querySelector('#countTag');
    let i = ((count.value * 1) + 1);
    let createBlock = document.createElement('div');

    createBlock.id = 'divTag_' + i;
    createBlock.classList = 'input-group mb-3';
    createBlock.innerHTML = divTag.innerHTML;
    createBlock.querySelector('#tag').name = 'tag_' + i;
    createBlock.querySelector('#buttonDeleteTag').value = 'divTag_' + i;
    createBlock.querySelector('#buttonDeleteTag').id = 'buttonDeleteTag_' + i;
    createBlock.querySelector('#tag').setAttribute('id', 'tag_' + i);
    count.value = i;
    i++;

    wrapper.append(createBlock);
}

/**
 * Delete Tag
 *
 * @param btn
 */
function deleteTag (btn) {
    let wrapper = document.querySelector('#wrapperTag');
    let div = document.querySelector('#' + btn.value)
    wrapper.removeChild(div);
}
