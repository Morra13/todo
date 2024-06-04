@extends('layouts.app', ['title' => __('Мои доступ')])
@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold text-body-emphasis">Ваши доступы</h1>
        @if(empty($arTodo))
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4 text-danger">У вас нет доступов</p>
            </div>
        @endif
    </div>
    @foreach($arTodo as $todo)
        @include('access.accessRow', ['todo' => $todo])
    @endforeach
@endsection
