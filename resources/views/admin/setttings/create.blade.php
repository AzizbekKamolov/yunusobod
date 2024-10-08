@extends('dashboard.home')
@section('head')
    <link href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.settings.settings') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("settings.store") }}" method="post" enctype="multipart/form-data">
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
                            <div class="form-row mt-3">
                                <div class="col-md-12 mb-3">
                                    <label for="action">{{ __('form.settings.action') }}</label>
                                    <select name="action" id="action" class="form-control">
                                        <option value="about_us">{{ __('web.menus.about_us') }}</option>
                                        <option value="activity">{{ __('web.menus.activity') }}</option>
                                        <option value="statistics">{{ __('web.menus.statistics') }}</option>
                                        <option value="partners">{{ __('web.menus.our_partners') }}</option>
                                    </select>
                                    @if($errors->has('action'))
                                        <div class="text-danger">{{ $errors->first('action') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="photo">{{ __('form.settings.photo') }}</label>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                    @if($errors->has('photo'))
                                        <div class="text-danger">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="navs-top-home-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="description_uz">{{ __('form.settings.description', locale: 'uz') }}</label>
                                            <textarea type="text" class="form-control" id="description_uz" name="description_uz" ></textarea>
                                            @if($errors->has('description_uz'))
                                                <div class="text-danger">{{ $errors->first('description_uz') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="navs-top-profile-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="description_ru">{{ __('form.settings.description', locale:'ru') }}</label>
                                            <textarea class="form-control" id="description_ru" name="description_ru" ></textarea>
                                            @if($errors->has('description_ru'))
                                                <div class="text-danger">{{ $errors->first('description_ru') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-messages-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="description_en">{{ __('form.settings.description', locale:'en') }}</label>
                                            <textarea class="form-control" id="description_en" name="description_en" ></textarea>
                                            @if($errors->has('description_en'))
                                                <div class="text-danger">{{ $errors->first('description_en') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('settings.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.add') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#description_uz').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });
        $('#description_ru').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });
        $('#description_en').summernote({
            // placeholder: 'Information university',
            tabsize: 2,
            height: 150
        });
    </script>
@endsection
