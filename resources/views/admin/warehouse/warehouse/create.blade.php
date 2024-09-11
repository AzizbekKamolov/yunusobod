@extends('dashboard.home')
@section('content')
    <div class="d-flex justify-content-center mt-5" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-10 col-xlg-9 col-md-8 ">
            <div class="card mb-4 shadow-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link  col-6" id="nav-profile-tab" data-toggle="tab" href="#my-profile"
                           role="tab" aria-controls="my-profile" aria-selected="false">{{ __('form.uz') }}</a>
                        <a class="nav-item nav-link col-6 active show" id="nav-contact-tab" data-toggle="tab"
                           href="#my-contact"
                           role="tab"
                           aria-controls="my-contact" aria-selected="true">{{ __('form.ru') }}</a>
                    </div>
                </nav>
                <div>
                    <form action="{{ route('warehouse.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade" id="my-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">
                                <div class="form-group justify-content-lg-start">
                                    <label class="col-md-12 mt-3"
                                           for="name[uz]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[uz]" class="form-control"
                                               id="name[uz]" value="{{ old('name.uz') }}"
                                               placeholder="{{ __('form.name_uz') }}"
                                        >
                                        @if($errors->has('name.uz'))
                                            <div class="text-danger">{{ $errors->first('name.uz') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group justify-content-lg-start">
                                    <label class="col-md-12 mt-2"
                                           for="description_uz">{{ __('validation.attributes.description') }}</label>
                                    <div class="col-md-12">
                                        <textarea rows="3" type="text" name="description_uz" class="form-control"
                                                  id="description_uz"
                                        >{{ old('description_uz') }}</textarea>
                                        @if($errors->has('description_uz'))
                                            <div class="text-danger">{{ $errors->first('description_uz') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="my-contact" role="tabpanel"
                                 aria-labelledby="nav-contact-tab">
                                <div class="form-group justify-content-end">
                                    <label class="col-md-12 mt-3"
                                           for="name[ru]">{{ __('validation.attributes.name') }}</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name[ru]" class="form-control" id="name[ru]"
                                               placeholder="{{ __('form.name_ru') }}" value="{{ old('name.ru') }}"
                                               required>
                                        @if($errors->has('name.ru'))
                                            <div class="text-danger">{{ $errors->first('name.ru') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group justify-content-end">
                                    <label class="col-md-12 mt-2"
                                           for="description_ru">{{ __('validation.attributes.description') }}</label>
                                    <div class="col-md-12">
                                        <textarea rows="3" type="text" name="description_ru" class="form-control"
                                                  id="description_ru"
                                        >{{ old('description_ru') }}</textarea>
                                        @if($errors->has('description_ru'))
                                            <div class="text-danger">{{ $errors->first('description_ru') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-row col-md-12">
                                <div class="col-md-2 mb-3">
                                    <label class="form-control-label"
                                           for="quantity">{{ __('validation.attributes.quantity') }}</label>
                                    <input name="quantity" value="{{ old('quantity') }}" type="text"
                                           class="form-control" id="quantity">
                                    @if($errors->has('quantity'))
                                        <div class="text-danger">{{ $errors->first('quantity') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-control-label"
                                           for="date_entered">{{ __('validation.attributes.date_entered') }}</label>
                                    <input name="date_entered" value="{{ old('date_entered') }}" type="date"
                                           class="form-control" id="date_entered">
                                    @if($errors->has('date_entered'))
                                        <div class="text-danger">{{ $errors->first('date_entered') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-control-label"
                                           for="expiry_date">{{ __('validation.attributes.expiry_date') }}</label>
                                    <input name="expiry_date" value="{{ old('expiry_date') }}" type="date"
                                           class="form-control" id="expiry_date">
                                    @if($errors->has('expiry_date'))
                                        <div class="text-danger">{{ $errors->first('expiry_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="accident_type_id">{{ __('form.warehouse.warehousecategory') }}</label>
                                    <select class="custom-select col-md-12" name="warehouse_category_id"
                                            id="warehouse_category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"> {{$category->hname}} </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('warehouse_category_id'))
                                        <div class="text-danger">{{ $errors->first('warehouse_category_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <a href="{{ route('warehouse.index') }}"
                                   class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                                <button class="btn btn-info">{{ __('form.add') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script src="{{ asset('assets/plugins/formatter/jquery.formatter.min.js') }}"></script>
            <script src="{{ asset('assets/js/formatter.js') }}"></script>
@endsection
