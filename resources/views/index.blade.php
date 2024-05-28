@extends('layouts.app', ['title' => __('Главная')])

@section('content')
    <div class="col-12 d-flex">
    @include('layouts.nav', ['arTodo' => $arTodo])
        <div class="col-9">
            @if(Auth::user())
                @foreach($arTodo as $todo)
                    @include('todo.todoRow', ['todo' => $todo])
                @endforeach
            @endif
        </div>
    </div>
@endsection
