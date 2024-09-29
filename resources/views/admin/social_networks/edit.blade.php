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
                    <form class="needs-validation" action="{{ route("social_networks.update", [$item->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12 mb-3">
                            <label for="name">{{ __('form.social_networks.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                            @if($errors->has('name'))
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="icon">{{ __('form.social_networks.icon') }}</label>
                            <textarea id="icon" name="icon" class="form-control">{{ $item->icon }}</textarea>
                            @if($errors->has('icon'))
                                <div class="text-danger">{{ $errors->first('icon') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="url">{{ __('form.social_networks.url') }}</label>
                            <input type="text" class="form-control" id="url" name="url" value="{{ $item->url }}">
                            @if($errors->has('url'))
                                <div class="text-danger">{{ $errors->first('url') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3 custom-control custom-checkbox">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       @checked($item->status)
                                       class="custom-control-input" id="status" name="status">
                                <label class="custom-control-label" for="status">{{ __('form.status') }}</label>
                            </div>
                            @if($errors->has('status'))
                                <div class="text-danger">{{ $errors->first('status') }}</div>
                            @endif
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('social_networks.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
