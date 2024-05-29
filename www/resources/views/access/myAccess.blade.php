@extends('layouts.app', ['title' => __('Мои доступ')])

@section('content')
    @foreach($arTodo as $todo)
        @include('access.accessRow', ['todo' => $todo])
    @endforeach
@endsection
