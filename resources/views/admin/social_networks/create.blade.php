@extends('dashboard.home')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.social_networks.social_networks') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("social_networks.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label for="name">{{ __('form.social_networks.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="icon">{{ __('form.social_networks.icon') }}</label>
                            <textarea id="icon" name="icon" class="form-control">{{ old('icon') }}</textarea>
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="url">{{ __('form.social_networks.url') }}</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('social_networks.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
