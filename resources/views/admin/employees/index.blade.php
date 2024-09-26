@extends('dashboard.home')
@section('content')
    <div class="row clearfix">
        <div class="col-md-12 col-lg-12">
            <div class="card mb-5 shadow-1">
                <div class="card-header">
                    <h4 class="card-header-title">
                        {{ __('form.employees.employees') }}
                    </h4>
                    {{--                    <div class="">--}}
                    @can('employees.store')
                        <a href="{{ route("employees.create") }}" class="btn btn-outline-success">
                            <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                        {{--                    </div>--}}
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive-lg">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('form.employees.photo') }}</th>
                            <th>{{ __('form.employees.fio') }}</th>
                            <th>{{ __('form.employees.about') }}</th>
                            <th>Order</th>
                            <th>{{ __('form.status') }}</th>
                        @canany(['employees.update', 'employees.delete'])
                                <th>{{ __('form.actions') }}</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagination->items() as $item)
                            <tr>
                                <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                                <td>
                                    <img src="{{ asset("/employees/$item->photo") }}" width="80" alt="photo">
                                </td>
                                <td>{{ $item->fio }}</td>
                                <td>{{ $item->aboutH }}</td>
                                <td>
                                    @if(!$loop->first)
                                        <a href="{{ route('employees.setOrder', [-$item->id]) }}"><i class="fa fa-arrow-up"></i></a>
                                    @endif
                                    @if(!$loop->last)
                                        <a href="{{ route('employees.setOrder', [$item->id]) }}"><i class="fa fa-arrow-down"></i></a>
                                    @endif
                                </td>
                                <td><span class="badge @if($item->status) badge-success @else badge-danger @endif">{{ $item->statusName }}</span></td>
                                <td>
                                    @can('employees.update')
                                        <a href="{{ route("employees.edit", [$item->id]) }}">
                                            <i class="fa fa-edit text-purple button-2x"></i></a>
                                    @endcan
                                    @can('employees.delete')
                                        <a href="{{ route("employees.delete", [$item->id]) }}" class=""
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
    </div>
@endsection
