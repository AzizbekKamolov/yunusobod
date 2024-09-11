<?php
declare(strict_types=1);

namespace App\ViewModels\Employees\Exam;

use Akbarali\ViewModel\BaseViewModel;
use App\DataObjects\Department\DepartmentData;
use App\DataObjects\Employees\EmployeeExamAttempt\EmployeeExamAttemptData;
use Carbon\Carbon;

class ExamViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public int $attempts_count;
    public string $duration;
    public int $department_id;
    public string $from_date;
    public ?string $fromDate;
    public string $to_date;
    public ?string $toDate;
    public bool $status = false;
    public string $statusName = 'bg-success';
    public bool $statusOriginal = true;
    public int $organization_id = 1;
    public int $questions_count = 0;
    public int $is_protected;
    public string $lang;
    public int $show_correct_answers;
    public ?string $created_at;
    public ?array $topics;
    public ?string $updated_at;
    public ?DepartmentData $department;
    public ?string $departmentName;
    public array|EmployeeExamAttemptData $employeeAttempt;

    protected function populate(): void
    {
        $this->questions_count = array_sum(array_column($this->topics, 'questions_count'));
        if ($this->status && count($this->employeeAttempt) < $this->attempts_count && date("Y-m-d H:i:s") <= $this->to_date) {
            $this->statusName = "bg-success";
            $this->statusOriginal = true;
        } else {
            $this->statusOriginal = false;
            $this->statusName = "bg-gray-500";
        }
        if (isset($this->department)) {
            $this->departmentName = $this->trans($this->department->name);
        }

        $this->created_at = Carbon::parse($this->created_at)->format('d-m-Y H:i');
        $this->fromDate = Carbon::parse($this->from_date)->format('d-m-Y H:i');
        $this->toDate = Carbon::parse($this->to_date)->format('d-m-Y H:i');
    }
}
