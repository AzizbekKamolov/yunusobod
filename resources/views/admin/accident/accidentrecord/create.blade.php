@extends('dashboard.home')
@section('head')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/js/select2.min.js') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="d-flex justify-content-center mt-5">
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
                    <form action="{{ route('accident.accidentrecord.store')}}" method="post"
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
                                               id="name[uz]"
                                               placeholder="{{ __('form.name_uz') }}"
                                        >
                                        @if($errors->has('name'))
                                            <div class="text-danger">{{ $errors->first('name') }}</div>
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
                                               placeholder="{{ __('form.name_ru') }}">
                                        @if($errors->has('name.uz'))
                                            <div class="text-danger">{{ $errors->first('name.uz') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-row col-md-12">
                                <div class="col-lg-12 mb-3">
                                    <label class="form-control-label"
                                           for="employee_id">{{ __('form.employees.employee') }}</label>
                                    <select class="form-control" name="employee_id" id="employee_id">

                                    </select>
                                    @if($errors->has('employee_id'))
                                        <div class="text-danger">{{ $errors->first('employee_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="begin_date">{{ __('validation.attributes.begin_date') }}</label>
                                    <input name="begin_date" value="{{ old('begin_date') }}" type="date"
                                           class="form-control" id="begin_date">
                                    @if($errors->has('begin_date'))
                                        <div class="text-danger">{{ $errors->first('begin_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="end_date">{{ __('validation.attributes.end_date') }}</label>
                                    <input name="end_date" value="{{ old('end_date') }}" type="date"
                                           class="form-control" id="end_date">
                                    @if($errors->has('end_date'))
                                        <div class="text-danger">{{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label"
                                           for="accident_type_id">{{ __('form.accident.accidenttype') }}</label>
                                    <select class="custom-select col-md-12" name="accident_type_id"
                                            id="accident_type_id">
                                        @foreach($accidenttypes as $accidentType)
                                            <option value="{{ $accidentType->id }}"> {{$accidentType->hname}} </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('accident_type_id'))
                                        <div class="text-danger">{{ $errors->first('accident_type_id') }}</div>
                                    @endif
                                </div>


                            </div>

                            <div class="col-md-12" id="special_titles">
                                <label for="validationTooltip03">{{ __('form.files.file') }}</label><span
                                    class="btn btn-outline-success ml-3 mb-2"
                                    id="special_titles_button"><i
                                        class="fa fa-plus-circle"></i></span>
                                <div class="form-row ">
                                    <div class="col-md-6 mb-3 ">
                                        <input type="file" class="form-control" id="validationTooltip03"
                                               name="files[0][file]">

                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <select name="files[0][lang]" class="form-control">
                                            <option value="ru">ru</option>
                                            <option value="uz">uz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <input name="files[0][uploaded_at]" type="date" class="form-control">
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                    </div>
                                    @if($errors->has('files.*'))
                                        <ul>
                                            @foreach($errors->get('files.*') as $errors)
                                                @foreach($errors as $error)
                                                    <div class="text-danger">
                                                        {{ $error }}
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <a href="{{ route('accident.accidentrecord.index') }}"
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
            {{--            <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>--}}
            {{--            <script src="{{ asset('assets/plugins/datepicker/js/datepicker.min.js') }}"></script>--}}
            {{--            <script src="{{ asset('assets/plugins/datepicker/js/datepicker.es.js') }}"></script>--}}
            <script>
                let counter = 0

                $('#special_titles_button').on('click', function (e) {
                    e.preventDefault()
                    counter++
                    console.log(1)
                    $('#special_titles').append(`<div class="form-row ">
                                    <div class="col-md-6 mb-3 ">
                                        <input type="file" class="form-control" id="validationTooltip03" name="files[${counter}][file]">

                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <select name="files[${counter}][lang]" class="form-control">

                                        <option value="ru">ru</option>
                                        <option value="uz">uz</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <input name="files[${counter}][uploaded_at]" type="date" class="form-control">
                                     </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-outline-danger special_titles_button_remove">-</span>
                                    </div>
                                </div>
    `)
                })
                document.addEventListener('click', function (e) {
                    if (e.target.classList.contains('special_titles_button_remove')) {
                        e.target.parentElement.parentElement.remove();
                    }
                })
            </script>
            <script>
                $(document).ready(function () {
                    $('#employee_id').select2({
                        allowClear: true,
                        // width: '300px',
                        height: '34px',
                        placeholder: '{{ __('form.employees.employee') }} {{ __('form.search') }}',
                        // allowClear: true,
                        minimumInputLength: 3,
                        ajax: {
                            delay: 200,
                            url: "{{ route('employees.getAll') }}",
                            dataType: 'json',
                            data: function (params) {
                                let search = {
                                    search: params.term,
                                    type: 'public'
                                }
                                // Query parameters will be ?search=[term]&type=public
                                return search;
                            },
                            processResults: function (data) {
                                console.log(data)
                                return {
                                    results: $.map(data, function (item) {
                                        console.log(item)
                                        return {
                                            text: item.fullname + ' (' + item.passport + ')',
                                            id: item.id
                                        }
                                    })
                                };
                            }
                        },
                        width: '100%',
                        // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        // placeholder: $(this).data('placeholder'),
                        // dropdownParent: $("#largeModal"),
                    });
                })
            </script>
@endsection
