@extends('dashboard.home')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.partners.partners') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("partners.update", [$item->id]) }}" method="post" enctype="multipart/form-data">
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
                            <div class="form-row mt-3">
                                <div class="col-md-12 mb-3">
                                    <label for="name">{{ __('form.partners.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" required value="{{ $item->name }}">
                                    @if($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade" id="navs-top-home-bgcolor">
                                    <div class="form-row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="about[uz]">{{ __('form.partners.about', locale: 'uz') }}</label>
                                            <textarea type="text" class="form-control" id="about[uz]" name="about[uz]" >{{ $item->about_uz }}</textarea>
                                            @if($errors->has('about.uz'))
                                                <div class="text-danger">{{ $errors->first('about.uz') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="navs-top-profile-bgcolor">
                                    <div class="form-row mt-3">

                                        <div class="col-md-12 mb-3">
                                            <label for="about[ru]">{{ __('form.partners.about', locale:'ru') }}</label>
                                            <textarea class="form-control" id="about[ru]" name="about[ru]" >{{ $item->about_ru }}</textarea>
                                            @if($errors->has('about.ru'))
                                                <div class="text-danger">{{ $errors->first('about.ru') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-messages-bgcolor">
                                    <div class="form-row mt-3">

                                        <div class="col-md-12 mb-3">
                                            <label for="about[en]">{{ __('form.partners.about', locale:'en') }}</label>
                                            <textarea class="form-control" id="about[en]" name="about[en]" >{{ $item->about_en }}</textarea>
                                            @if($errors->has('about.en'))
                                                <div class="text-danger">{{ $errors->first('about.en') }}</div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <img src="{{ asset("/sliders/$item->photo") }}" width="150" alt="photo">
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-md-12 mb-3">
                                    <label for="photo">{{ __('form.sliders.file') }}</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                    @if($errors->has('photo'))
                                        <div class="text-danger">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('partners.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
