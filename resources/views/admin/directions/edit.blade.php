@extends('dashboard.home')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.directions.directions') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("directions.update", [$item->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="nav-tabs-top">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#navs-top-home-bgcolor">UZ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#navs-top-profile-bgcolor">RU</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#navs-top-messages-bgcolor">EN</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="navs-top-home-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title[uz]">{{ __('form.directions.title', locale:'uz') }}</label>
                                            <input type="text" class="form-control" id="title[uz]" name="title[uz]" required value="{{ $item->title_uz }}">
                                            @if($errors->has('title.uz'))
                                                <div class="text-danger">{{ $errors->first('title.uz') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description[uz]">{{ __('form.directions.description', locale: 'uz') }}</label>
                                            <textarea type="text[uz]" class="form-control" id="description[uz]" name="description[uz]" >{{ $item->description_uz }}</textarea>
                                            @if($errors->has('description.uz'))
                                                <div class="text-danger">{{ $errors->first('description.uz') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="navs-top-profile-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title[ru]">{{ __('form.directions.title', locale: 'ru') }}</label>
                                            <input type="text" class="form-control" id="title[ru]" name="title[ru]" required value="{{ $item->title_ru }}">
                                            @if($errors->has('title.ru'))
                                                <div class="text-danger">{{ $errors->first('title.ru') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description[ru]">{{ __('form.directions.description', locale:'ru') }}</label>
                                            <textarea class="form-control" id="description[ru]" name="description[ru]" >{{ $item->description_ru }}</textarea>
                                            @if($errors->has('description.ru'))
                                                <div class="text-danger">{{ $errors->first('description.ru') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-messages-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title[en]">{{ __('form.directions.title', locale: 'en') }}</label>
                                            <input type="text" class="form-control" id="title[en]" name="title[en]" required value="{{ $item->title_en }}">
                                            @if($errors->has('title.en'))
                                                <div class="text-danger">{{ $errors->first('title.en') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description[en]">{{ __('form.directions.description', locale:'en') }}</label>
                                            <textarea class="form-control" id="description[en]" name="description[en]" >{{ $item->description_en }}</textarea>
                                            @if($errors->has('description.en'))
                                                <div class="text-danger">{{ $errors->first('description.en') }}</div>
                                            @endif
                                        </div>

                                    </div>
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
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('directions.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
