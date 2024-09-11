<table class="table table-responsive-sm">
    <thead>
    <tr>
        <th>{{ __('form.employees.employee') }}</th>
        <th>{{ __('form.accident.accidenttype') }}</th>
        <th>{{ __('validation.attributes.description') }}</th>
        <th>{{ __('validation.attributes.begin_date') }}</th>
        <th>{{ __('validation.attributes.end_date') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($accidentRecords as $accidentrecord)
        <tr>
            <td>{{ $accidentrecord->employee->fullname }}</td>
            <td>{{ $accidentrecord->accidentType->hname}}</td>
            <td>{{ $accidentrecord->hname}}</td>
            <td>{{ $accidentrecord->begin_date}}</td>
            <td>{{ $accidentrecord->end_date}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
