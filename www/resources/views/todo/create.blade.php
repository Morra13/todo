@extends('layouts.app', ['title' => __('Создать дело')])

@section('content')
    <div id="wrapperForMain">
        <div class="row g-5 justify-content-center">
            <div class="col-md-7 col-lg-6" id="shell">
                <h4 class="mb-5 ">{{ __('Создать дело') }}</h4>
                <form action="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_CREATE) }}" method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation" id="formCreateTodo">
                    @method('post')
                    @csrf
                    <div class="row g-3">
                        <div class="row g-0">
                            <div class="col-md-4 card-profile-image">
                                <label for="chooseFile">
                                    <img width="150px" height="150px" id="img" src="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" alt="img">
                                </label>
                                <input
                                    id="chooseFile"
                                    name="img"
                                    type="file"
                                    class="d-none"
                                    onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])"
                                    accept=".jpg,.jpeg,.png"
                                />
                                <button class="btn btn-danger rounded-circle p-3 lh-1" type="button" onclick="deleteImg()">X</button>
                            </div>
                            <div class="col-sm-8">
                                <label for="name" class="form-label">{{ __('Название дела') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="text" class="form-label">{{ __('Текст') }}  </label>
                            <input type="text" class="form-control" id="text" name="text" placeholder="{{ __('Текст') }}" required>
                        </div>
                        <div id="wrapperTask" class="col-12">
                            <label for="task_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                {{ __('Задачи') }}
                                <button type="button" class="input-group-text bg-primary" onclick="addTask()">+</button>
                            </label>
                            <input type="hidden" id="countTask" name="countTask" value="0">
                            <div id="divTask" class="input-group mb-3 d-none">
                                <span class="input-group-text"></span>
                                <input type="text" class="form-control" id="task" name="task" placeholder="{{ __('Задача') }}">
                                <button type="button" class="input-group-text bg-danger" id="buttonDeleteTask" value="divTask" onclick="deleteTask(this)">-</button>
                            </div>
                            <div id="divTask_0" class="input-group mb-3">
                                <span class="input-group-text"></span>
                                <input type="text" class="form-control" id="task_0" name="task_0" placeholder="{{ __('Задача') }}">
                                <button type="button" class="input-group-text bg-danger" id="buttonDeleteTask_0" value="divTask_0" onclick="deleteTask(this)">-</button>
                            </div>
                        </div>
                        <div id="wrapperTag" class="col-12">
                            <label for="tag_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                {{ __('Теги') }}
                                <button type="button" class="input-group-text bg-primary" onclick="addTag()">+</button>
                            </label>
                            <input type="hidden" id="countTag" name="countTag" value="0">
                            <div id="divTag" class="input-group mb-3 d-none">
                                <span class="input-group-text">#</span>
                                <input type="text" class="form-control" id="tag" name="tag" placeholder="{{ __('Тег') }}">
                                <button type="button" class="input-group-text bg-danger" id="buttonDeleteTag" value="divTag" onclick="deleteTag(this)">-</button>
                            </div>
                            <div id="divTag_0" class="input-group mb-3">
                                <span class="input-group-text">#</span>
                                <input type="text" class="form-control" id="tag_0" name="tag_0" placeholder="{{ __('Тег') }}">
                                <button type="button" class="input-group-text bg-danger" id="buttonDeleteTag_0" value="divTag_0" onclick="deleteTag(this)">-</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="userId" name="userId" value="{{ auth()->id() }}">
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit" value="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_CREATE) }}" onclick="todoAjax(this)">{{ __('Создать дело') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
