@extends('employee.dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.medical_orders.medical_order') }}
                </h4>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('form.medical_orders.content') }}</th>
                        <th>{{ __('form.medical_orders.date') }}</th>
                        <th>{{ __('form.medical.medical_order_file') }}</th>
                        <th>{{ __('form.medical.medical_result_date') }}</th>
                        <th>{{ __('form.medical.medical_status') }}</th>
                        <th>{{ __('form.medical.medical_result_file') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $medical_order)
                        <tr>
                            <td>{{ $medical_order->content }}</a></td>
                            <td>{{ $medical_order->date }}</td>
                            <td>
                                @if(isset($medical_order->files))
                                    @foreach($medical_order->files as $file)
                                        @include('employee.medical.file')
                                        <span data-toggle="modal" data-target="#m_modal_{{ $file->id }}"> <i
                                                class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                                    @endforeach
                                @endif
                            </td>
                            @if(isset($medical_order->medical_results))
                                @foreach($medical_order->medical_results as $medical_result)
                                    <td>{{ $medical_result->date }}</td>
                                @foreach($medical_statuses as $medical_status)
                                    @if($medical_result->medical_status_id == $medical_status->id)
                                            <td>{{ $medical_status->hname }}</td>
                                    @endif
                                @endforeach
                                    <td>
                                        @if(isset($medical_result->files))
                                            @foreach($medical_result->files as $file)
                                                @include('employee.medical.file')
                                                <span data-toggle="modal" data-target="#m_modal_{{ $file->id }}"> <i
                                                        class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                                            @endforeach
                                        @endif
                                    </td>
                                @endforeach
                        @endif
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
