<?php
declare(strict_types=1);
namespace App\ActionData\Accident\AccidentRecord;

use Akbarali\ActionData\ActionDataBase;

class CreateAccidentRecordActionData extends ActionDataBase
{
    public ?int $id;
    public ?array $name;
    public ?int $employee_id;
    public int $accident_type_id;
    public ?string $begin_date;
    public ?string $end_date;
    public $files;

    protected array $rules =[
        'name' => 'nullable|array',
        'name.*' => 'nullable|string',
        'employee_id' => 'required|exists:employees,id',
        'accident_type_id' => 'required|exists:accident_types,id',
        'begin_date' => 'required|before:end_date',
        'end_date' => 'required|after:begin_date',
        'files' => 'required|array',
        'files.*.file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'required|in:uz,ru',
    ];
}
