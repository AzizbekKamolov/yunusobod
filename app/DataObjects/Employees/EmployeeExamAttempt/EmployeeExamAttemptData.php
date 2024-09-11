<?php
declare(strict_types=1);
namespace App\DataObjects\Employees\EmployeeExamAttempt;

use Akbarali\DataObject\DataObjectBase;
use App\DataObjects\File\FileData;

class   EmployeeExamAttemptData extends DataObjectBase
{
    public int $id;
    public int $employee_id;
    public string $start_time;
    public string $end_time;
    public int $exam_id;
    public int $question_count;
    public int $correct_answers_count = 0;
    public array $questions;
    public ?array $employee_answers;
    public ?string $body = '';
    public bool $attempt_completed;
    public bool $exists_practical = true;
    public ?int $checked_by;
    public ?array $checked_answers = [];
    public int $organization_id = 1;
}
