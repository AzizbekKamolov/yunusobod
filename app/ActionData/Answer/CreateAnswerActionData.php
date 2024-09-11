<?php
declare(strict_types = 1);
namespace App\ActionData\Answer;

use Akbarali\ActionData\ActionDataBase;

class CreateAnswerActionData extends ActionDataBase{

    public ?string $content;
    public ?bool $is_correct = false;
    public ?int $question_id;

    protected array $rules = [
        'content' => "required",
        'is_correct' => "required|boolean",
    ];
}
