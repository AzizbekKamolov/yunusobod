<?php

namespace App\ActionData\Accident\AccidentRecord;

use Akbarali\ActionData\ActionDataBase;

class UpdateAccidentRecordActionData extends ActionDataBase
{

    public ?int $id;
    public int $accident_type_id;
    public ?array $name;
    public ?string $begin_date;
    public ?string $end_date;
    public $files;

    protected array $rules =[
        'name' => 'nullable|array',
        'name.*' => 'nullable|string',
        'accident_type_id' => 'required|exists:accident_types,id',
        'begin_date' => 'required|before:end_date',
        'end_date' => 'required|after:begin_date',
        'files' => 'nullable|array',
        'files.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'nullable|in:uz,ru',
    ];
}
