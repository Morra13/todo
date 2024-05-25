let i = 1;
const wrapper = document.querySelector('#wrapper');
const divTag = document.querySelector('#divTag');

function addTag() {
    let createInput = document.createElement('input')
    createInput.classList = 'd-none';
    createInput.name = 'count';
    createInput.value = i;
    let createBlock = document.createElement('div');
    createBlock.classList = 'input-group mb-3';
    createBlock.innerHTML = divTag.innerHTML;
    createBlock.querySelector('#tag_0').name = 'tag_' + i;
    createBlock.querySelector('#tag_0').setAttribute('id', 'tag_' + i);
    i++;
    wrapper.append(createBlock);
    wrapper.append(createInput);
}
