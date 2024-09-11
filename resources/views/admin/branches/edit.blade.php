@extends('dashboard.home')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-10  col-md-12 ">

            <div class="card mb-4 shadow-1">
                <div class="card-body ">
                    <form action="{{ route('branches.update', [ $branch->id]) }} " method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="example-email"
                                   class="col-md-12">{{ __('validation.attributes.name') }}</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control"
                                       name="name" value="{{ $branch->name }}" id="example-email">
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
                                       name="address" value="{{ $branch->address }}" id="example-email">
                                @if($errors->has('address'))
                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('branches.index') }}" class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info">{{ __('form.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
