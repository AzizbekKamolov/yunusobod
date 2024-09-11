@extends('employee.dashboard.home')

@section('content')
    <div class="col-md-12 col-lg-12">

        <div class="card mb-4 shadow-1">

            <div class="card-header">
                <h4 class="card-header-title">
                    {{ __('form.accident.accident') }}
                </h4>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table class="table table-responsive-sm">
                    <thead>
                    <tr>
                        <th>{{ __('validation.attributes.description') }}</th>
                        <th>{{ __('form.accident.accidenttype') }}</th>
                        <th>{{ __('validation.attributes.begin_date') }}</th>
                        <th>{{ __('validation.attributes.end_date') }}</th>
                        <th>{{ __('form.medical.medical_result_file') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination->items() as $accident_record)
                        <tr>
                            <td>{{ $accident_record->hname }}</a></td>
                            @foreach($types as $accident_type)
                                @if($accident_record->accident_type_id == $accident_type->id)
                                    <td>{{ $accident_type->hname }}</td>
                                @endif
                            @endforeach
                            <td>{{ $accident_record->begin_date }}</td>
                            <td>{{ $accident_record->end_date }}</td>
                            <td>
                                @if(isset($accident_record->files))
                                    @foreach($accident_record->files as $file)
                                        @include('employee.accident.file')
                                        <span data-toggle="modal" data-target="#m_accident_{{ $file->id }}"> <i
                                                class="btn fa fa-file-pdf-o ml-3"> {{ $file->lang }} </i> </span>
                                    @endforeach
                                @endif
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
