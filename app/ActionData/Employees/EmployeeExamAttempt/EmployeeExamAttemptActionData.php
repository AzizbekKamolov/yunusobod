<?php
declare(strict_types=1);
namespace App\ActionData\Employees\EmployeeExamAttempt;

use Akbarali\ActionData\ActionDataBase;

class EmployeeExamAttemptActionData extends ActionDataBase
{
    public int $employee_id;
    public string $start_time;
    public string $end_time;
    public int $exam_id;
    public int $question_count;
    public int $correct_answers_count = 0;
    public array $questions;
    public ?array $employee_answers;
    public ?string $body = '';
    public ?int $checked_by;
    public ?array $checked_answers = [];
    public bool $attempt_completed = false;
    public int $organization_id = 1;

    public function prepare():void
    {
        $this->rules = [
          "employee_id" => "required|int",
          "start_time" => "required|date_format:Y-m-d H:i:s",
          "end_time" => "required|date_format:Y-m-d H:i:s",
          "exam_id" => "required|int",
          "question_count" => "required|int",
          "questions" => "required|array",
          "attempt_completed" => "nullable|bool",
        ];
    }
}
