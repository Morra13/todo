@extends('layouts.app', ['title' => __('Измениь дело')])

@section('content')
    <div class="container">
        <main>
            <div class="row g-5 justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <h4 class="mb-5 ">{{ __('Измениь дело') }}</h4>
                    <form action="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_UPDATE) }}" method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation">
                        @method('post')
                        @csrf
                        <div class="row g-3">
                            <div class="row g-0">
                                <div class="col-md-4 card-profile-image">
                                    <label for="chooseFile">
                                        <img width="150px" height="150px" id="img" src="{{ asset('storage') . '/' . ($arTodo['img'] ?? 'uploads/defaultUploadImg.png') }}" alt="img">
                                    </label>
                                    <button class="btn btn-danger rounded-circle p-3 lh-1" type="button" onclick="deleteImg()">X</button>
                                    <input
                                        id="chooseFile"
                                        name="img"
                                        type="file"
                                        class="d-none"
                                        onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
                                        accept=".jpg,.jpeg,.png"
                                    />
                                </div>
                                <div class="col-sm-8">
                                    <label for="name" class="form-label">{{ __('Название дела') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $arTodo['name'] }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="text" class="form-label">{{ __('Текст') }}  </label>
                                <input type="text" class="form-control" id="text" name="text" placeholder="{{ __('Текст') }}" value="{{ $arTodo['text'] }}">
                            </div>
                            <div id="wrapperTask" class="col-12">
                                <label for="task_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                    {{ __('Задачи') }}
                                    <button type="button" class="input-group-text bg-primary" onclick="addTask()">+</button>
                                </label>
                                <input type="hidden" id="countTasks" name="countTasks" value="{{ count($arTodo['tasks']) }}">
                                <div id="divTask" class="input-group mb-3 d-none">
                                    <div class="btn-group me-2" role="group" aria-label="First group">
                                        <input type="radio" class="btn-check input-group-text" name="taskStatus" id="taskStatusExpect_" autocomplete="off" value="expect" checked>
                                        <label class="btn btn-outline-secondary" for="taskStatusExpect_" title="{{ __('В ожидании') }}" id="taskLabelExpect_"></label>
                                        <input type="radio" class="btn-check input-group-text" name="taskStatus" id="taskStatusWork_" autocomplete="off" value="work">
                                        <label class="btn btn-outline-primary" for="taskStatusWork_" title="{{ __('В работе') }}" id="taskLabelWork_"></label>
                                        <input type="radio" class="btn-check input-group-text" name="taskStatus" id="taskStatusCompleted_" autocomplete="off" value="completed">
                                        <label class="btn btn-outline-success" for="taskStatusCompleted_" title="{{ __('В завершен') }}" id="taskLabelCompleted_"></label>
                                    </div>
                                    <input type="text" class="form-control" id="task_" name="task_" placeholder="{{ __('Задача') }}">
                                    <button type="button" class="input-group-text bg-danger" id="buttonDeleteTask" value="divTask" onclick="deleteTask(this)">-</button>
                                </div>
                                @if($arTodo['tasks'])
                                    @foreach($arTodo['tasks'] as $key => $task)
                                        <div id="{{ "divTask_" . $key }}" class="input-group mb-3">
                                            <div class="btn-group me-2" role="group" aria-label="First group">
                                                <input type="radio" class="btn-check input-group-text" name="taskStatus_{{ $key }}" id="vbtn-radio1" autocomplete="off" value="expect" @if($task['status'] == 'expect') checked @endif>
                                                <label class="btn btn-outline-secondary" for="vbtn-radio1" title="{{ __('В ожидании') }}"></label>
                                                <input type="radio" class="btn-check input-group-text" name="taskStatus_{{ $key }}" id="vbtn-radio2" autocomplete="off" value="work" @if($task['status'] == 'work') checked @endif>
                                                <label class="btn btn-outline-primary" for="vbtn-radio2" title="{{ __('В работе') }}"></label>
                                                <input type="radio" class="btn-check input-group-text" name="taskStatus_{{ $key }}" id="vbtn-radio3" autocomplete="off" value="completed" @if($task['status'] == 'completed') checked @endif>
                                                <label class="btn btn-outline-success" for="vbtn-radio3" title="{{ __('В завершен') }}"></label>
                                            </div>
                                            <input type="text" class="form-control" id="{{ "task_" . $key }}" name="{{ "task_" . $key }}" placeholder="{{ __('Задача') }}" value="{{ $task['task'] }}">
                                            <button type="button" class="input-group-text bg-danger" id="{{ "buttonDeleteTask_" . $key }}" value="{{ "divTask_" . $key }}" onclick="deleteTask(this)">-</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div id="wrapperTag" class="col-12">
                                <label for="tag_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                    {{ __('Теги') }}
                                    <button type="button" class="input-group-text bg-primary" onclick="addTag()">+</button>
                                </label>
                                <input type="hidden" id="countTag" name="countTag" value="{{ count($arTodo['tags']) }}">
                                <div id="divTag" class="input-group mb-3 d-none">
                                    <span class="input-group-text">#</span>
                                    <input type="text" class="form-control" id="tag" name="tag" placeholder="{{ __('Тег') }}">
                                    <button type="button" class="input-group-text bg-danger" id="buttonDeleteTag" value="divTag" onclick="deleteTag(this)">-</button>
                                </div>
                                @if($arTodo['tags'])
                                    @foreach($arTodo['tags'] as $key => $tag)
                                        <div id="{{ "divTag_" . $key }}" class="input-group mb-3">
                                            <span class="input-group-text">#</span>
                                            <input type="text" class="form-control" id="{{ "tag_" . $key }}" name="{{ "tag_" . $key }}" placeholder="{{ __('Тег') }}" value="{{ $tag['tag'] }}">
                                            <button type="button" class="input-group-text bg-danger" id="{{ "buttonDeleteTag_" . $key }}" value="{{ "divTag_" . $key }}" onclick="deleteTag(this)">-</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <input type="hidden" id="todoId" name="todoId" value="{{ $arTodo['id'] }}">
                        <hr class="my-4">
                        <div class="d-flex gap-4">
                            <a href="{{ route(\App\Http\Controllers\AccessController::ROUTE_ADD_ACCESS, $arTodo->id) }}" class="w-100 btn btn-warning btn-lg" type="submit">{{ __('Дать доступ') }}</a>
                            <a href="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_DELETE, $arTodo->id) }}" class="w-100 btn btn-danger btn-lg" type="submit">{{ __('Удалить') }}</a>
                            <button class="w-100 btn btn-primary btn-lg" type="submit">{{ __('Измениь дело') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
