<table>
    <thead>
    <tr>
        <th>{{ __('validation.attributes.fullname') }}</th>
        <th>{{ __('validation.attributes.passport') }}</th>
        <th>{{ __('validation.attributes.pinfl') }}</th>
        <th>{{ __('validation.attributes.birthdate') }}</th>
        <th>{{ __('form.departments.department') }}</th>
        <th>{{ __('form.positions.position') }}</th>
        <th>{{ __('form.branches.branch') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->fullname }}</td>
            <td>{{ $employee->passport }}</td>
            <td>{{ $employee->pinfl }}</td>
            <td>{{ $employee->birthdate }}</td>
            <td>{{ $employee->department->hname}}</td>
            <td>{{ $employee->position->hname}}</td>
            <td>{{ $employee->branch->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
