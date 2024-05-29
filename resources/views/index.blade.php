@extends('layouts.app', ['title' => __('Главная')])

@section('content')
    <div class="col-12 d-flex">
    @include('layouts.nav', ['arTodo' => $arTodo])
        <div class="col-9" id="wrapper">
            <form method="post" action="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_DELETE, 0) }}" autocomplete="off" enctype="multipart/form-data" id="formDeleteTodo" name="formDeleteTodo">
            @method('post')
            @csrf
            @if(Auth::user())
                @foreach($arTodo as $todo)
                    @include('todo.todoRow', ['todo' => $todo])
                @endforeach
            @endif
            </form>
        </div>
    </div>
@endsection
