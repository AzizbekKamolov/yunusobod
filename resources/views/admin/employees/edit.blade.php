@extends('dashboard.home')
@section('head')
    <style>
        input[name="passport"] {
            text-transform: uppercase;
        }
    </style>
@endsection
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-lg-12  col-md-12 ">

            <div class="card mb-4 shadow-1">
                <div class="card-body ">
                    <form action="{{ route('employees.update',[$employee->id]) }} " method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-row col col-md-9">
                                <div class="col-md-8 mb-3">
                                    <label for="fullname"
                                           class="form-control-label">{{ __('validation.attributes.fullname') }}</label>
                                    <input type="text" value="{{ $employee->fullname }}" class="form-control"
                                           name="fullname" id="fullname">
                                    @if($errors->has('fullname'))
                                        <div class="text-danger">{{ $errors->first('fullname') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="birthdate"
                                           class="form-control-label">{{ __('validation.attributes.birthdate') }}</label>
                                    <input type="date" value="{{ $employee->birthdate }}" class="form-control"
                                           name="birthdate" id="birthdate">
                                    @if($errors->has('birthdate'))
                                        <div class="text-danger">{{ $errors->first('birthdate') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="pinfl"
                                           class="form-control-label">{{ __('validation.attributes.pinfl') }}</label>
                                    <input type="text" value="{{ $employee->pinfl }}" class="form-control"
                                           name="pinfl" id="pinfl">
                                    @if($errors->has('pinfl'))
                                        <div class="text-danger">{{ $errors->first('pinfl') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="passport"
                                           class="form-control-label">{{ __('validation.attributes.passport') }}</label>
                                    <input type="text" value="{{ $employee->passport  }}" class="form-control"
                                           name="passport" id="passport">
                                    @if($errors->has('passport'))
                                        <div class="text-danger">{{ $errors->first('passport') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row ml-2">
                                @if(isset($employee->file))
                                    <div class="profile-pic-container">
                                        <img src="{{ asset('profile/'.$employee->file['path'])}}" class=" profile-pic"
                                             alt="">
                                        <a href="{{ route('employees.fileDelete',[$employee->file['id']]) }}"
                                           class="delete-icon" title="{{ __('form.delete') }}"><i
                                                class="ion-ios-trash-outline"></i></a>
                                    </div>
                                @else
                                    <div class="profile-pic-container ">
                                        <img src="{{  asset('assets/images/user/user2.png')}}"
                                             class="img-fluid profile-pic" alt="">
                                    </div>
                                @endif
                            </div>
                            <div class="form-row col col-md-12 mb-1">
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="position_id">{{ __('form.positions.positions') }}</label>
                                    <select class="custom-select col-md-12" name="position_id" id="position_id">
                                        <option value="" selected
                                                disabled> {{ __('form.select',['attribute' => __('form.positions.position')]) }} </option>
                                        @foreach($positions as $position)
                                            <option
                                                value="{{ $position->id }}" @selected($position->id == $employee->position->id )> {{$position->hname}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="inputGroupSelect01">{{ __('form.branches.branches') }}</label>
                                    <select class="custom-select col-md-12" name="branch_id" id="inputGroupSelect01">
                                        <option value="" selected
                                                disabled> {{ __('form.select',['attribute' => __('form.branches.branch')]) }} </option>
                                        @foreach($branches as $branch)
                                            <option
                                                value="{{ $branch->id }}" @selected($branch->id == $employee->branch->id  )> {{$branch->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="photo">{{ __('validation.attributes.photo') }}</label>
                                    <input type="file" name="photo" class="form-control">
                                    @if($errors->has('photo'))
                                        <div class="text-danger">{{ $errors->first('photo') }}</div>
                                    @endif
                                </div>
                                @can('update_password')
                                    <div class="col-md-6 mb-3">
                                        <label for="username"
                                               class="form-control-label">{{ __('validation.attributes.username') }}</label>
                                        <input type="text" value="{{ $employee->username  }}" class="form-control"
                                               name="username" id="username">
                                        @if($errors->has('username'))
                                            <div class="text-danger">{{ $errors->first('username') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password"
                                               class="form-control-label">{{ __('validation.attributes.password') }}</label>
                                        <input type="password" value="{{ old('password')  }}" class="form-control"
                                               name="password" id="password">
                                        @if($errors->has('password'))
                                            <div class="text-danger">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('employees.index') }}"
                               class="btn btn-slack ">{{{ __('form.cancel') }}}</a>
                            <button class="btn btn-info ">{{ __('form.save') }}</button>
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
<style>
    .profile-pic-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 120px;
        margin: 0 auto;
    }

    .profile-pic {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .delete-icon {
        margin-top: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: red;
        font-size: 20px;
    }

    .delete-icon i {
        display: flex;
        align-items: center;
        justify-content: center;
    }

</style>
