@extends('layouts.app', ['title' => __('Авторизация')])

@section('content')
    <div class="row justify-content-center">
        <form class="w-25" method="post" enctype="multipart/form-data" action="{{ route(\App\Http\Controllers\Auth\AuthController::ROUTE_AUTH) }}">
            @method('post')
            @csrf
            <h1 class="h3 mb-3 fw-normal">{{ __('Авторизация') }}</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Email') }}">
                <label for="email">{{ __('Email') }}</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Пароль') }}">
                <label for="password">{{ __('Пароль') }}</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">{{ __('Авторизация') }}</button>
            <p><a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_REGISTER) }}" class="link-offset-3" >{{ __('Регистрация') }}</a></p>
        </form>
    </div>
@endsection
