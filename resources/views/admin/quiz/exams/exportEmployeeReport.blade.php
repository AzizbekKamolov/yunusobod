<table>
    <thead>
    <tr>
        <th>{{ __('validation.attributes.fullname') }}</th>
        <th>{{ __('validation.attributes.passport') }}</th>
        {{--        <th>{{ __('form.departments.department') }}</th>--}}
        <th>{{ __('form.positions.position') }}</th>
        {{--        <th>{{ __('form.branches.branch') }}</th>--}}
        <th>{{ __('quiz.questions.questions_count') }}</th>
        <th>{{ __('quiz.employee.correct_answers_count') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        @php $correctAnswersCount = null; $checkedBy = null; @endphp
        @foreach($employee->employeeExamAttempts as $attempt)
            @php $correctAnswersCount = $attempt->correct_answers_count; $checkedBy = $attempt->checked_by; @endphp
            @break
        @endforeach
        <tr @if(is_null($checkedBy)) class="bg-light" @endif>
            <td>
               {{ $employee->fullname }}
            </td>
            <td>{{ $employee->passport }}</td>
            {{--            <td>{{ $employee->department->hname}}</td>--}}
            <td>{{ $employee->position->hname}}</td>
            <td>{{ array_sum(array_column($exam->topics, 'questions_count')) }}</td>
            <td>
                {{ $correctAnswersCount }}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

