@extends('layouts.app', ['title' => __('Создать дело')])

@section('content')
    <div class="container">
        <main>
            <div class="row g-5 justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <h4 class="mb-5 ">{{ __('Создать дело') }}</h4>
                    <form action="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_CREATE) }}" method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation">
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
                                </div>
                                <div class="col-sm-8">
                                    <label for="name" class="form-label">{{ __('Название дела') }}</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="text" class="form-label">{{ __('Текст') }}  </label>
                                <input type="text" class="form-control" id="text" name="text" placeholder="{{ __('Текст') }}">
                            </div>
                            <div id="wrapper" class="col-12">
                                <label for="tag_0" class="form-label d-flex justify-content-between text-align-center align-items-center">
                                    {{ __('Теги') }}
                                    <button type="button" class="input-group-text bg-primary" onclick="addTag()">+</button>
                                </label>
                                <input type="hidden" id="count" name="count" value="0">
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
                        <button class="w-100 btn btn-primary btn-lg" type="submit">{{ __('Создать дело') }}</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
