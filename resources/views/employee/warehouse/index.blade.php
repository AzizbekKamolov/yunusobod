@extends('employee.dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.warehouse.products') }}
                </h4>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.name') }}</th>
                        <th>{{ __('form.warehouse.warehousecategory') }}</th>
                        <th>{{ __('validation.attributes.quantity') }}</th>
                        <th>{{ __('validation.attributes.date_given') }}</th>
                        <th>{{ __('validation.attributes.entry_date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $employee_product)
                        <tr>
                            <td>{{ $employee_product->warehouse->hname }}</a></td>
                            <td>{{ $employee_product->warehouse_category->hname }}</td>
                            <td>{{ $employee_product->quantity }}</td>
                            <td>{{ $employee_product->date_given }}</td>
                            <td>{{ $employee_product->entry_date }}</td>

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
