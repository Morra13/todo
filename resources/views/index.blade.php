@extends('layouts.app', ['title' => __('Главная')])

@section('content')
    @if(Auth::user())
        @foreach($arTodo as $todo)
            @include('todo.todoRow', ['todo' => $todo])
        @endforeach
    @endif
@endsection
