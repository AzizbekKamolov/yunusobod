@extends('dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.warehouse.products') }}
                </h4>
                @include('admin.warehouse.warehouse.export')
                @can('view_warehouse')
                    <span data-toggle="modal" data-target="#m_warehouse_export"> <i class="btn fa fa-file-excel-o ml-3">{{ __('form.download') }} </i> </span>
                @endcan
                @can('create_warehouse')
                    <a href="{{ route("warehouse.create") }}" class="btn btn-outline-success">
                        <i class="fa fa-plus button-2x"> {{ __('form.add') }}</i></a>
                @endcan
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <form action="{{ route("warehouse.index") }}">
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
                                <input type="text" class="form-control" name="search"
                                       placeholder="{{ __('validation.attributes.name') }}"
                                       value="{{ request('search') }}">
                            </td>
                            <td>
                                <select class="form-control select2 select2-hidden-accessible" tabindex="-1"
                                        aria-hidden="true" id="warehouse_category_id" name="warehouse_category_id">
                                    <option value="" selected
                                            disabled>{{ __('form.warehouse.warehousecategory') }} {{ __('form.choose') }}</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            @selected(request('warehouse_category_id') == $category->id)
                                        >{{ $category->hname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="row">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('warehouse.index') }}" class="btn btn-outline-info"><i
                                            class="fa fa-refresh"></i></a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('form.warehouse.warehousecategory') }}</th>
                        <th>{{ __('validation.attributes.quantity') }}</th>
                        <th>{{ __('validation.attributes.remaining_quantity') }}</th>
                        <th>{{ __('validation.attributes.date_entered') }}</th>
                        <th>{{ __('validation.attributes.expiry_date') }}</th>
                        @canany(['delete_warehouse','update_warehouse'])
                            <th>{{ __('form.actions') }}</th>
                        @endcanany
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $warehouse)
                        <tr>
                            <th scope="row">{{ ($pagination->currentpage()-1) * $pagination->perpage() + $loop->index + 1 }}</th>
                            <td><a href="{{ route('warehouse.show', [$warehouse->id]) }}">{{ $warehouse->hname }}</a>
                            </td>
                            <td>{{ $warehouse->warehouse_category->hname}}</td>
                            <td>{{ $warehouse->quantity }}</td>
                            <td>{{ $warehouse->remaining_quantity}}</td>
                            <td>{{ $warehouse->date_entered}}</td>
                            <td>{{ $warehouse->expiry_date}}</td>
                            <td>
                                @can('update_warehouse')
                                    <a href="{{ route("warehouse.edit", [$warehouse->id]) }}">
                                        <i class="fa fa-edit text-purple button-2x"></i></a>
                                @endcan
                                @can('delete_warehouse')
                                    <a href="{{ route("warehouse.delete", [$warehouse->id]) }}" class=""
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
