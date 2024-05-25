<header class="mb-4 p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            @if(Auth::user())
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    @if(substr(\Request::getRequestUri(),1) == '')
                        <li><a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" class="nav-link px-2">{{ __('Главная') }}</a></li>
                    @else
                        <li><a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" class="nav-link px-2 text-white">{{ __('Главная') }}</a></li>
                    @endif
                    @if(substr(\Request::getRequestUri(),1) == 'createTodo')
                        <li><a href="{{ route(\App\Http\Controllers\TodoController::ROUTE_CREATE) }}" class="nav-link px-2">{{ __('Создать дело') }}</a></li>
                    @else
                        <li><a href="{{ route(\App\Http\Controllers\TodoController::ROUTE_CREATE) }}" class="nav-link px-2 text-white">{{ __('Создать дело') }}</a></li>
                    @endif
                </ul>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                </form>
                <div class="text-end">
                    <a href="{{ route(\App\Http\Controllers\Auth\AuthController::ROUTE_LOGOUT) }}" type="button" class="btn btn-warning">{{ __('Выйти') }}</a>
                </div>
            @endif
        </div>
    </div>
</header>
