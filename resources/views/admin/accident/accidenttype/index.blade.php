@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.accident.accidenttype') }}
                </h4>
                @can('create_accidenttype')
                    <a href="{{ route("accident.accidenttype.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('form.accident.accidentrecords') }}</th>
                        @canany(['delete_accidenttype','update_accidentrecord'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $accidentType)
                        <tr>
                            <td>{{ $accidentType->hname }}</td>
                            <td>{{ $accidentType->accidentRecords}}</td>
                            <td>
                                @can('update_accidenttype')
                                    <a href="{{ route("accident.accidenttype.edit", [$accidentType->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_accidenttype')
                                    <a href="{{ route("accident.accidenttype.delete", [$accidentType->id]) }}" class=""
                                       onclick="return confirm(this.getAttribute('data-message'));"
                                       data-message="{{ __('form.confirm_delete') }}">
                                        <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
