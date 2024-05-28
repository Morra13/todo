<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark col-3">
    <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"></svg>
        <span class="fs-6">{{ __('Поиск по названию') }}</span>
    </span>
    <form action="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" method="get" autocomplete="off" enctype="multipart/form-data" class="needs-validation mb-5" role="search">
        @method('get')
        @csrf
        <input type="search" class="form-control form-control-dark text-bg-dark mb-2" aria-label="Search" id="search" name="search" required>
        <div class="d-flex gap-2 justify-content-center">
            <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" type="submit" class="btn btn-warning ">{{ __('Сросить') }}</a>
            <button type="submit" class="btn btn-primary">{{ __('Поиск') }}</button>
        </div>
    </form>
    <span class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"></svg>
        <span class="fs-4">{{ __('Тэги') }}</span>
    </span>
    <form action="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" method="get" autocomplete="off" enctype="multipart/form-data" class="needs-validation">
        @method('get')
        @csrf
        <ul class="nav nav-pills flex-column mb-auto">
            <select multiple id="multiSelect" class="form-select mb-2">
                @foreach($arAvailableTags as $arTags)
                    @foreach($arTags as $tag)
                        <option data-linked-checkbox="{{ $tag }}">{{ $tag }}</option>
                    @endforeach
                @endforeach
                @foreach($arAvailableTags as $arTags)
                    @foreach($arTags as $key => $tag)
                        <input type="checkbox" id="{{ $tag }}" name="{{ $tag }}" value="{{ $key }}" hidden>
                    @endforeach
                @endforeach
            </select>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ route(\App\Http\Controllers\PublicController::ROUTE_MAIN) }}" type="submit" class="btn btn-warning ">{{ __('Сросить') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Фильтр') }}</button>
            </div>
        </ul>
    </form>
</div>
<script>
    document.querySelectorAll('select[multiple] option').forEach(option => {
        const linkedCheckboxId = option.dataset.linkedCheckbox;
        const linkedCheckbox = document.getElementById(linkedCheckboxId);

        option.addEventListener('mousedown', (e) => {
            e.preventDefault();
            linkedCheckbox.checked = !linkedCheckbox.checked;
            option.selected = linkedCheckbox.checked;
            option.parentNode.dispatchEvent(new Event('change'));
        });
    });
</script>
