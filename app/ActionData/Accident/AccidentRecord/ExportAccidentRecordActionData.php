<?php

namespace App\ActionData\Accident\AccidentRecord;

use Akbarali\ActionData\ActionDataBase;

class ExportAccidentRecordActionData extends ActionDataBase
{

    public ?int $accident_type_id ;
    public ?string $from;
    public ?string $to;

    protected array $rules  = [
        'accident_type_id' => 'nullable|exists:accident_types,id',
        'from' => 'required|before:to',
        'to' => 'required|after:from'
    ];
}
