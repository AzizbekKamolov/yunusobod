<table >
    <thead>
    <tr>
        <th>{{ __('validation.attributes.fullname') }}</th>
        <th>{{ __('form.branches.branch') }}</th>
        <th>{{ __('form.positions.position') }}</th>
        <th>{{ __('validation.attributes.quantity') }}</th>
        <th>{{ __('validation.attributes.date_given') }}</th>
        <th>{{ __('validation.attributes.entry_date') }}</th>
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
        </tr>
    @endforeach
    </tbody>
</table>
