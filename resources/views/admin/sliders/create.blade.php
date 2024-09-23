@extends('dashboard.home')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.sliders.sliders') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("sliders.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                                            <label for="title[uz]">{{ __('form.sliders.title', locale:'uz') }}</label>
                                            <input type="text" class="form-control" id="title[uz]" name="title[uz]" required value="{{ old('title.uz') }}">
                                            @if($errors->has('title.uz'))
                                                <div class="text-danger">{{ $errors->first('title.uz') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="content[uz]">{{ __('form.sliders.content', locale:'uz') }}</label>
                                            <input type="text" class="form-control" id="content[uz]" name="content[uz]" required value="{{ old('content.uz') }}">
                                            @if($errors->has('content.uz'))
                                                <div class="text-danger">{{ $errors->first('content.uz') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="body">{{ __('form.sliders.body', locale: 'uz') }}</label>
                                            <textarea type="text[uz]" class="form-control" id="body[uz]" name="body[uz]" ></textarea>
                                            @if($errors->has('body.uz'))
                                                <div class="text-danger">{{ $errors->first('body.uz') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="navs-top-profile-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title[ru]">{{ __('form.sliders.title', locale: 'ru') }}</label>
                                            <input type="text" class="form-control" id="title[ru]" name="title[ru]" required value="{{ old('title.ru') }}">
                                            @if($errors->has('title.ru'))
                                                <div class="text-danger">{{ $errors->first('title.ru') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="content[ru]">{{ __('form.sliders.content', locale: 'ru') }}</label>
                                            <input type="text" class="form-control" id="content[ru]" name="content[ru]" required value="{{ old('content.ru') }}">
                                            @if($errors->has('content.ru'))
                                                <div class="text-danger">{{ $errors->first('content.ru') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="body">{{ __('form.sliders.body', locale:'ru') }}</label>
                                            <textarea class="form-control" id="body[ru]" name="body[ru]" ></textarea>
                                            @if($errors->has('body.ru'))
                                                <div class="text-danger">{{ $errors->first('body.ru') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-messages-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title[en]">{{ __('form.sliders.title', locale: 'en') }}</label>
                                            <input type="text" class="form-control" id="title[en]" name="title[en]" required value="{{ old('title.en') }}">
                                            @if($errors->has('title.en'))
                                                <div class="text-danger">{{ $errors->first('title.en') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="content[en]">{{ __('form.sliders.content', locale: 'en') }}</label>
                                            <input type="text" class="form-control" id="content[en]" name="content[en]" required value="{{ old('content.en') }}">
                                            @if($errors->has('content.en'))
                                                <div class="text-danger">{{ $errors->first('content.en') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="body">{{ __('form.sliders.body', locale:'en') }}</label>
                                            <textarea class="form-control" id="body[en]" name="body[en]" ></textarea>
                                            @if($errors->has('body.en'))
                                                <div class="text-danger">{{ $errors->first('body.en') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="file">{{ __('form.sliders.file') }}</label>
                                <input type="file" class="form-control" id="file" name="file">
                                @if($errors->has('file'))
                                    <div class="text-danger">{{ $errors->first('file') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('sliders.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection