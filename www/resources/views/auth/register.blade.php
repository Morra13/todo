@extends('layouts.app', ['title' => __('Регистрация')])

@section('content')
    <div class="row justify-content-center">
        <form class="w-25" method="post" autocomplete="off" enctype="multipart/form-data" action="{{ route(\App\Http\Controllers\Auth\AuthController::ROUTE_REGISTER) }}">
            @method('post')
            @csrf
            <h1 class="h3 mb-3 fw-normal">{{ __('Регистрация') }}</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Имя') }}">
                <label for="name" class="{{ $errors->has('name') ? 'text-danger' : '' }}">{{ __('Имя') }}</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Email') }}">
                <label for="email" class="{{ $errors->has('email') ? 'text-danger' : '' }}">{{ __('Email') }}</label>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Пароль') }}">
                <label for="password" class="{{ $errors->has('password') ? 'text-danger' : '' }}">{{ __('Пароль') }}</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Подтвердите пароль') }}">
                <label for="password_confirmation" class="{{ $errors->has('password') ? 'text-danger' : '' }}">{{ __('Подтвердите пароль') }}</label>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">{{ __('Зарегистрироваться') }}</button>
            <p><a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_AUTH) }}" class="link-offset-3" >{{ __('Авторизация') }}</a></p>
        </form>
    </div>
@endsection
