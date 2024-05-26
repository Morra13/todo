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
                            <div id="wrapper" class="col-12">
                                <label for="tag_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                    {{ __('Теги') }}
                                    <button type="button" class="input-group-text bg-primary" onclick="addTag()">+</button>
                                </label>
                                <input type="hidden" id="count" name="count" value="{{ count($arTodo['tags']) }}">
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
                            <a href="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_DELETE, $arTodo->id) }}" class="w-100 btn btn-danger btn-lg" type="submit">{{ __('Удалить') }}</a>
                            <button class="w-100 btn btn-primary btn-lg" type="submit">{{ __('Измениь дело') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
