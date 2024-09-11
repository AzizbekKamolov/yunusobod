<?php

namespace App\ActionData\Medical\MedicalOrder;

use Akbarali\ActionData\ActionDataBase;

class UpdateMedicalOrderActionData extends ActionDataBase
{
    public ?int $id;
    public ?string $content;
    public ?string $description;
    public ?string $date;
    public ?array $employees;
    public ?array $files;
    protected array $rules = [
        "content" => "required|string",
        'description' => 'nullable|string',
        'date' => 'required',
        'employees' => 'required|array',
        'employees.*' => 'required|exists:employees,id',
        'files' => 'nullable|array',
        'files.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'nullable|in:uz,ru',
    ];
}
