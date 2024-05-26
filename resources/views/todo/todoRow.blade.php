<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="row featurette">
        <div class="col-md-9 order-md-2">
            <h2 class="featurette-heading fw-normal lh-1"> Name </h2>
            <p class="lead"> TEXT </p>
            <div class="d-flex justify-content-end gap-4">
                <a href="{{ route(\App\Http\Controllers\Api\TodoController::ROUTE_DELETE, 1) }}" class="btn btn-outline-danger">Удалить</a>
                <a href="{{ route(\App\Http\Controllers\TodoController::ROUTE_CHANGE, 2) }}" class="btn btn-primary">Редактировать</a>
            </div>
        </div>
        <div class="col-md-3 order-md-1 d-flex align-items-center justify-content-center">
            <a href="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" target="_blank">
                <img width="150px" height="150px" id="img" src="{{ asset('storage') . '/uploads/defaultUploadImg.png'}}" alt="img" target="_blank">
            </a>
        </div>
    </div>
</div>
