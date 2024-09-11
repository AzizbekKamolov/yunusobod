@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-10  col-md-12 ">

            <div class="card mb-4 shadow-1">
                <div class="card-body ">
                    <form action="{{ route('organizations.update',[$item->id]) }} " method="get">
                        @csrf
                        <div class="form-group">
                            <label for="example-email"
                                   class="col-md-12">{{ __('validation.attributes.name') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control"
                                       name="name" id="example-email"
                                       value="{{ $item->name }}"
                                >
                                @if($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email"
                                   class="col-md-12">{{ __('validation.attributes.address') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control"
                                       name="address" id="example-email" value="{{ $item->address }}">
                                @if($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-12">{{ __('validation.attributes.phone') }}</label>
                            <div class="col-md-12">
                                <input type="text" name="phone" class="form-control" value="{{ $item->hphone }}"
                                       id="phone">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">{{ __('validation.attributes.description') }}</label>
                            <div class="col-md-12">
                                <input type="text" name="description" value="{{ $item?->description }}"
                                       class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('organizations.index') }}"
                               class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('assets/plugins/formatter/jquery.formatter.min.js') }}"></script>
    <script src="{{ asset('assets/js/formatter.js') }}"></script>
@endsection
