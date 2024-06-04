/**
 * Add task block
 */
function addTask(type) {
    const wrapper = document.querySelector('#wrapperTask');
    const divTask = document.querySelector('#divTask');
    let count = document.querySelector('#countTasks');
    let i = ((count.value * 1) + 1);
    let createBlock = document.createElement('div');
    createBlock.id = 'divTask_' + i;
    createBlock.classList = 'input-group mb-3';
    createBlock.innerHTML = divTask.innerHTML;
    createBlock.querySelector('#task_').name = 'task_' + i;
    createBlock.querySelector('#buttonDeleteTask').value = 'divTask_' + i;
    if (type != 'create') {
        createBlock.querySelector('#taskStatusExpect_').name      = 'taskStatus_' + i;
        createBlock.querySelector('#taskStatusWork_').name        = 'taskStatus_' + i;
        createBlock.querySelector('#taskStatusCompleted_').name   = 'taskStatus_' + i;
        createBlock.querySelector('#taskStatusExpect_').id      = 'taskStatusExpect_' + i;
        createBlock.querySelector('#taskStatusWork_').id        = 'taskStatusWork_' + i;
        createBlock.querySelector('#taskStatusCompleted_').id   = 'taskStatusCompleted_' + i;
        createBlock.querySelector('#taskLabelExpect_').attributes['for'].value      = 'taskStatusExpect_' + i;
        createBlock.querySelector('#taskLabelWork_').attributes['for'].value       = 'taskStatusWork_' + i;
        createBlock.querySelector('#taskLabelCompleted_').attributes['for'].value   = 'taskStatusCompleted_' + i;
    }
    createBlock.querySelector('#buttonDeleteTask').id = 'buttonDeleteTask_' + i;
    createBlock.querySelector('#task_').setAttribute('id', 'task_' + i);
    count.value = i;
    i++;

    wrapper.append(createBlock);
}

/**
 * Delete Task
 *
 * @param btn
 */
function deleteTask (btn) {
    let wrapper = document.querySelector('#wrapperTask');
    let div = document.querySelector('#' + btn.value)
    wrapper.removeChild(div);
}
