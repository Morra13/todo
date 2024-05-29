<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="row featurette">
        <div class="col-md-9 order-md-2">
            <h2 class="featurette-heading fw-normal lh-1"> {{ $todo->name }} </h2>
            <p class="lead"> {{ $todo->text }} </p>
            @if($todo['tags'])
                @foreach($todo['tags'] as $tag)
                    <span class="badge rounded-pill text-bg-info"> {{ "#" . $tag['tag'] }}</span>
                @endforeach
            @endif
            <div>
                @if($todo['access'])
                    @foreach($todo['access'] as $access)
                        <span class="badge rounded-pill text-bg-warning"> {{ $access['name'] }}</span>
                    @endforeach
                @endif
            </div>
            <div class="d-flex justify-content-end gap-4 mb-2">
                <a href="{{ route(\App\Http\Controllers\AccessController::ROUTE_ADD_ACCESS, $todo->id) }}" class="btn btn-outline-warning">Дать доступ</a>
                <button value="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_DELETE, $todo->id) }}" onclick="deleteTodoAjax(this)" class="btn btn-outline-danger" type="submit">Удалить</button>
                <a href="{{ route(\App\Http\Controllers\TodoController::ROUTE_CHANGE, $todo->id) }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>
        <div class="col-md-3 order-md-1 d-flex align-items-center justify-content-center">
            <a href="{{ asset('storage') . '/' . ($todo->img ?? 'uploads/defaultUploadImg.png') }}" target="_blank">
                <img width="150px" height="150px" id="img" src="{{ asset('storage') . '/' . ($todo->img ?? 'uploads/defaultUploadImg.png') }}" alt="img" target="_blank">
            </a>
        </div>
    </div>
</div>
