@extends('dashboard.home')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-4 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.employees.employees') }}
                    </h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route("employees.update", [$item->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
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
                                    <div class="col-md-12 mb-3 mt-3">
                                        <label for="about[uz]">{{ __('form.employees.about', locale: 'uz') }}</label>
                                        <textarea name="about[uz]" id="about[uz]" class="form-control">{{ $item->about_uz }}</textarea>
                                        @if($errors->has('about[uz]'))
                                            <div class="text-danger">{{ $errors->first('about[uz]') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="navs-top-profile-bgcolor">
                                    <div class="col-md-12 mb-3 mt-3">
                                        <label for="about[ru]">{{ __('form.employees.about',locale: 'ru') }}</label>
                                        <textarea name="about[ru]" id="about[ru]" class="form-control">{{ $item->about_ru }}</textarea>
                                        @if($errors->has('about[ru]'))
                                            <div class="text-danger">{{ $errors->first('about[ru]') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-top-messages-bgcolor">
                                    <div class="col-md-12 mb-3 mt-3">
                                        <label for="about[en]">{{ __('form.employees.about', locale: 'en') }}</label>
                                        <textarea name="about[en]" id="about[en]" class="form-control">{{ $item->about_en }}</textarea>
                                        @if($errors->has('about[en]'))
                                            <div class="text-danger">{{ $errors->first('about[en]') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="fio">{{ __('form.employees.fio') }}</label>
                                <input type="text" class="form-control" id="fio" name="fio" value="{{ $item->fio }}">
                                @if($errors->has('fio'))
                                    <div class="text-danger">{{ $errors->first('fio') }}</div>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <img src="{{ asset("/employees/$item->photo") }}" width="80" alt="photo">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="photo">{{ __('form.employees.photo') }}</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                @if($errors->has('photo'))
                                    <div class="text-danger">{{ $errors->first('photo   ') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="direction_id">{{ __('form.directions.direction') }}</label>
                                <select name="direction_id" id="direction_id" class="form-control">
                                    @foreach($directions as $direction)
                                        <option value="{{ $direction->id }}" @selected($item->direction_id == $direction->id)>{{ $direction->titleH }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('direction_id'))
                                    <div class="text-danger">{{ $errors->first('direction_id') }}</div>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="experience">{{ __('form.employees.experience') }}(2 yil)</label>
                                <input type="number" class="form-control" id="experience" name="experience"
                                       value="{{ $item->experience }}">
                                @if($errors->has('experience'))
                                    <div class="text-danger">{{ $errors->first('experience') }}</div>
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


                        </div>

                        <div class="form-group text-center">
                            <a href="{{ route('employees.index') }}" class="btn btn-slack">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-success " type="submit">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
