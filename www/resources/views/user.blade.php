@extends('layouts.app', ['title' => Auth::user()->name])

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-7 col-lg-8 ">
            <h4 class="mb-3">{{ __('Данные пользователя') }}</h4>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <span class="input-group-text">{{ __('ID: ') }}</span>
                            <input type="text" class="form-control" id="id" placeholder="id"  value="{{ Auth::user()->id }}" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <span class="input-group-text">{{ __('Имя: ') }}</span>
                            <input type="text" class="form-control" id="name" placeholder="name" value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="email" class="form-control" id="email" placeholder="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>
                <hr class="my-4">
            </div>
        </div>
    </div>
@endsection
