@extends('dashboard.home')

@section('head')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/js/select2.min.js') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="col-md-12 col-lg-12">
        <div class="card mb-4 shadow-1">
            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.warehouse.warehouse') }}
                </h4>
                @can('view_warehouse')
                    <a href="{{ route('warehouse.exportProductEmployees', [$item->id]) }}">
                        <i class="fa fa-file-excel-o  button-2x"></i></a>
                @endcan
            </div>
            <div class="card mb-4 shadow-1 d-flex justify-content-lg-center">
                <div class="card-body ">
                    <div class="form-row ">
                        <div class="col-md-8 mb-3">
                            <label for="content"
                                   class="form-control-label">{{ __('validation.attributes.name') }}</label>
                            <input readonly type="text" class="form-control"
                                   name="content" id="content" value="{{ $item->hname}}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="warehouse_category_id"
                                   class="form-control-label">{{ __('form.warehouse.warehousecategory') }}</label>
                            <select disabled class="custom-select " name="warehouse_category_id"
                                    id="warehouse_category_id">
                                <option
                                    value="{{ $item->warehouse_category->id }}"> {{$item->warehouse_category->hname}} </option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="content"
                                   class="form-control-label">{{ __('validation.attributes.quantity') }}</label>
                            <input readonly type="text" class="form-control"
                                   name="content" id="content" value="{{ $item->quantity}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="content"
                                   class="form-control-label">{{ __('validation.attributes.remaining_quantity') }}</label>
                            <input readonly type="text" class="form-control"
                                   name="content" id="content" value="{{ $item->remaining_quantity}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date"
                                   class="form-control-label">{{ __('validation.attributes.date_entered') }}</label>
                            <input readonly type="date" value="{{ $item->date_entered }}" class="form-control"
                                   name="date" id="date">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date"
                                   class="form-control-label">{{ __('validation.attributes.expiry_date') }}</label>
                            <input readonly type="date" value="{{ $item->expiry_date}}" class="form-control"
                                   name="date" id="date">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-control-label"
                                   for="content">{{ __('validation.attributes.description') }}</label>
                            <textarea readonly type="text" name="description_" class="form-control" id="content"
                                      cols="30"
                                      rows="3"> {{ $item?->{"description_".app()->getLocale()} }}</textarea>
                        </div>
                    </div>
                    <hr style="border: 1px solid slategray; border-radius: 2px;">
                    @if($item->remaining_quantity > 0)
                        <div id="accordionHeaderbg">
                            <div class="card mb-2">
                                <div class="card-header  bg-success">
                                    <a class="text-light collapsed col-md-12 " data-toggle="collapse"
                                       href="#accordionHeaderbg1"
                                       aria-expanded="@if($errors->any()) true @else false @endif"
                                       data-original-title="" title="" data-init="true">
                                        <i>{{ __('form.employee_add_click') }}</i>
                                    </a>
                                </div>
                                <div id="accordionHeaderbg1" class="collapse @if($errors->any()) show @endif"
                                     data-parent="#accordionHeaderbg" style="">
                                    <div class="card-body">
                                        <div>
                                            <form action="{{ route('employee_product.store') }}" method="post">
                                                @csrf
                                                <div class="col-12 mb-3">
                                                    <label class="form-control-label"
                                                           for="employee_id">{{ __('form.employees.employee') }}</label>
                                                    <select class="form-control" name="employee_id" id="employee_id">

                                                    </select>
                                                    @if($errors->has('employee_id'))
                                                        <div
                                                            class="text-danger">{{ $errors->first('employee_id') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-row">
                                                    <input type="hidden" name="warehouse_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="warehouse_category_id"
                                                           value="{{ $item->warehouse_category->id }}">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="quantity"
                                                               class="form-control-label">{{ __('validation.attributes.quantity') }}</label>
                                                        <input type="text" class="form-control"
                                                               name="quantity" id="quantity"
                                                               placeholder="{{'max: '. $item->remaining_quantity}}"
                                                               value="{{ old('quantity')}}">
                                                        @if($errors->has('quantity'))
                                                            <div
                                                                class="text-danger">{{ $errors->first('quantity') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="date_given"
                                                               class="form-control-label">{{ __('validation.attributes.date_given') }}</label>
                                                        <input type="date" value="{{ old('date_given') }}"
                                                               class="form-control"
                                                               name="date_given" id="date_given">
                                                        @if($errors->has('date_given'))
                                                            <div
                                                                class="text-danger">{{ $errors->first('date_given') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="entry_date"
                                                               class="form-control-label">{{ __('validation.attributes.entry_date') }}</label>
                                                        <input type="date" value="{{ old('entry_date')}}"
                                                               class="form-control"
                                                               name="entry_date" id="entry_date">
                                                        @if($errors->has('entry_date'))
                                                            <div
                                                                class="text-danger">{{ $errors->first('entry_date') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-control-label"
                                                               for="content">{{ __('validation.attributes.description') }}</label>
                                                        <textarea type="text" name="description" class="form-control"
                                                                  id="content"
                                                                  cols="30"
                                                                  rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn  btn-info col-md-1">{{ __('form.add') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body collapse show col-md-12" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.fullname') }}</th>
                        <th>{{ __('form.branches.branch') }}</th>
                        <th>{{ __('form.positions.position') }}</th>
                        <th>{{ __('validation.attributes.quantity') }}</th>
                        <th>{{ __('validation.attributes.date_given') }}</th>
                        <th>{{ __('validation.attributes.entry_date') }}</th>
                        <th>{{ __('form.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee_products as $employee_product)
                        <tr>
                            <td>{{ $employee_product->employee->fullname }}</td>
                            <td>{{ $employee_product->employee->branch->name}}</td>
                            <td>{{ $employee_product->employee->position->hname}}</td>
                            <td>{{ $employee_product->quantity }}</td>
                            <td>{{ $employee_product->date_given }}</td>
                            <td>{{ $employee_product->entry_date }}</td>
                            <td>
                                <a href="{{ route("employee_product.delete", [$employee_product->id,$item->id]) }}">
                                    <i class="fa fa-trash-o text-danger button-2x"></i></a>
                                @include('admin.warehouse.warehouse.employee_product_edit')
                                <span data-toggle="modal" data-target="#m_employeeProduct_{{ $employee_product->id }}"> <i
                                        class="fa fa-edit text-purple button-2x"></i></span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
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


