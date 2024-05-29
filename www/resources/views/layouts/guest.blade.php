@extends('layouts.app', ['title' => __('Гость')])

@section('content')
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">{{ __('Вы не авторизованы') }}</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Зарегистрируйтесь, либо же авторизуйтесь :)
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_AUTH) }}" class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" type="button">
                   Авторизоваться
                </a>
                <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_REGISTER) }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">
                    Зарегистрироваться
                </a>
            </div>
        </div>
    </div>`
@endsection
