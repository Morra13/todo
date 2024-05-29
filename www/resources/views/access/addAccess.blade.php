@extends('layouts.app', ['title' => __('Дать доступ')])

@section('content')
    <div id="wrapper">
        <form action="{{ route(\App\Http\Controllers\Api\AccessController::ROUTE_ADD_ACCESS) }}" method="post" autocomplete="off" enctype="multipart/form-data" class="needs-validation" id="formAddAccess" name="formAddAccess">
            @method('post')
            @csrf
            <div class="d-flex flex-column flex-md-row p-1 gap-1 py-md-1 align-items-center justify-content-center">
                <div class="col-lg-4 d-flex flex-column flex-row justify-content-center align-items-center">
                    <img src="{{ asset('storage') . '/' .($arTodo->img ?? 'uploads/defaultUploadImg.png')}}" height="150px" width="150px">
                    <h2 class="fw-normal">{{ __($arTodo->name) }}</h2>
                    <p>{{ $arTodo->text }}</p>
                    <input type="hidden" name="todoId" value="{{ $arTodo->id }}">
                </div>
            </div>
            <div class="d-flex align-items-md-stretch flex-column flex-md-row p-1 gap-1 py-md-1 align-items-center justify-content-center">
                <table class="table text-center access-table">
                    <thead>
                    <tr>
                        <th style="width: 34%;"></th>
                        <th style="width: 22%;">{{ __('Полный доступ') }}</th>
                        <th style="width: 22%;">{{ __('Только чтение') }}</th>
                        <th>{{ __('Удалить доступ') }}</th>
                    </tr>
                    </thead>
                    <tr id="access-row-none" class="d-none">
                        <th scope="row" class="text-start"></th>
                        <td class="access-all">
                            <span class="d-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            </span>
                        </td>
                        <td class="access-read">
                            <span class="d-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-danger rounded-circle p-2 lh-1">X</a>
                        </td>
                    </tr>
                    @if(!empty($arTodo->access))
                        @foreach($arTodo->access as $access)
                            <tbody>
                                <tr id="access-row-{{ $access['userId'] }}">
                                    <th scope="row" class="text-start">{{ $access['userName'] }}</th>
                                    <td class="access-all">
                                        <span class="@if($access['type'] == 'read') d-none @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </span>
                                    </td>
                                   <td class="access-read">
                                        <span class="@if($access['type'] == 'all') d-none @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </svg>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="submit" value="{{ route(\App\Http\Controllers\Api\AccessController::ROUTE_DELETE_ACCESS, [$access['userId'] , $arTodo['id']]) }}" onclick="accessAjax(this)" class="btn btn-danger rounded-circle p-2 lh-1">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @endif
                </table>
            </div>
            <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-4 align-items-center justify-content-center">
                <div class="list-group  col-4">
                    <label class="list-group-item d-flex gap-2">
                        <input class="form-check-input flex-shrink-0" type="radio" name="type" id="typeRead" value="read" checked>
                        <span>
                            {{ __('Чтение') }}
                        </span>
                    </label>
                    <label class="list-group-item d-flex gap-2">
                        <input class="form-check-input flex-shrink-0" type="radio" name="type" id="typeAll" value="all">
                        <span>
                            {{ __('Полный доступ') }}
                        </span>
                    </label>
                </div>
                <div class="list-group  col-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" title="{{ $sUsers }}">ID пользователя</span>
                        <input type="text" class="form-control" id="userId" name="userId" placeholder="ID" required>
                    </div>
                </div>
            </div>
            <input type="hidden" name="todoUserId" value="{{ $arTodo->userId }}">
            <div class="d-flex align-items-center justify-content-center">
                <div class="list-group  col-5">
                    <button class="btn btn-primary" type="submit" value="{{ route(\App\Http\Controllers\Api\AccessController::ROUTE_ADD_ACCESS) }}" onclick="accessAjax(this)">Дать доступы</button>
                </div>
            </div>
        </form>
    </div>
@endsection
