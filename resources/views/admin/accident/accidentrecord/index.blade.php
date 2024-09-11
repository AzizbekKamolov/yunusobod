@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.accident.accidentrecords') }}
                </h4>
                @include('admin.accident.accidentrecord.export')
                @can('view_accidentrecord')
                    <span data-toggle="modal" data-target="#m_accidentrecord_export"> <i class="btn fa fa-file-excel-o ml-3">{{ __('form.download') }} </i> </span>
                @endcan
                @can('create_accidentrecord')
                    <a href="{{ route("accident.accidentrecord.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <form action="{{ route('accident.accidentrecord.index') }}">
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" name="limit"
                                        style="width: 65px">
                                    <option value="5" @selected(request('limit') == 5)>5</option>
                                    <option value="10" @selected(request('limit') == 10 || is_null(request('limit')))>
                                        10
                                    </option>
                                    <option value="20" @selected(request('limit') == 20)>20</option>
                                    <option value="30" @selected(request('limit') == 30)>30</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="accident_type_id" name="accident_type_id">
                                    <option value="" selected
                                            disabled>{{ __('form.accident.accidenttype') }} {{ __('form.choose') }}</option>
                                    @foreach($accidentTypes as $accident_type)
                                        <option
                                            value="{{ $accident_type->id }}"
                                            @selected(request('accident_type_id') == $accident_type->id)
                                        >{{ $accident_type->hname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="row">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('accident.accidentrecord.index') }}" class="btn btn-outline-info"><i
                                            class="fa fa-refresh"></i></a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>{{ __('form.employees.employee') }}</th>
                        <th>{{ __('form.accident.accidenttype') }}</th>
                        <th>{{ __('validation.attributes.description') }}</th>
                        <th>{{ __('validation.attributes.begin_date') }}</th>
                        <th>{{ __('validation.attributes.end_date') }}</th>
                        @canany(['delete_accidentrecord','upadte_accidentrecord'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $accidentrecord)
                        <tr>
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td>{{ $accidentrecord->employee->fullname }}</td>
                            <td>{{ $accidentrecord->accidentType->hname}}</td>
                            <td>{{ $accidentrecord->hname}}</td>
                            <td>{{ $accidentrecord->begin_date}}</td>
                            <td>{{ $accidentrecord->end_date}}</td>
                            <td>
                                @can('update_accidentrecord')
                                    <a href="{{ route("accident.accidentrecord.edit", [$accidentrecord->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_accidentrecord')
                                    <a href="{{ route("accident.accidentrecord.delete", [$accidentrecord->id]) }}"
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <nav class="d-flex justify-content-between">
                    <span>{{ __('form.showed') }}: <b>{{ $pagination->count() }}</b></span>
                    {{ $pagination->links('pagination::bootstrap-4') }}
                    <span>{{ __('form.total') }}: <b>{{ $pagination->total() }}</b></span>
                </nav>
            </div>
        </div>
    </div>

@endsection
