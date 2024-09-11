@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.medical_orders.medical_order') }}
                </h4>
                @can('create_medicalorder')
                    <a href="{{ route("medical.orders.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('form.medical_orders.content') }}</th>
                        <th>{{ __('form.medical_orders.date') }}</th>
                        <th>{{ __('form.medical_orders.description') }}</th>
                        <th>{{ __('form.employees.employees') }}</th>
                        @canany(['update_medicalorder','delete_medicalorder'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $medical_order)
                        <tr>
                            <td>
                                <a href="{{ route('medical.orders.show', [$medical_order->id]) }}">{{ $medical_order->content }}</a>
                            </td>
                            <td>{{ $medical_order->date }}</td>
                            <td>{{ $medical_order->description }}</td>
                            <td>{{ $medical_order->order_employees_count }}</td>
                            <td>
                                @can('view_medicalorder')
                                    <a href="{{ route("medical.orders.export", [$medical_order->id]) }}">
                                        <i class="fa fa-file-excel-o  button-2x"></i></a>
                                @endcan
                                @can('update_medicalorder')
                                    <a href="{{ route("medical.orders.edit", [$medical_order->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan

                                @can('delete_medicalorder')
                                    <a href="{{ route("medical.orders.delete", [$medical_order->id]) }}" class=""
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
