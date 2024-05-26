@extends('layouts.app', ['title' => __('Главная')])

@section('content')
    @if(Auth::user())
        @include('todo.todoRow', ['id', Auth::user()->id])
    @endif
@endsection
