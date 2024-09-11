<?php
declare(strict_types=1);
namespace App\ActionData\Medical\MrdicalResult;

use Akbarali\ActionData\ActionDataBase;

class UpdateMedicalResultActionData extends ActionDataBase
{
    public ?int $id;
    public ?int $employee_id;
    public ?int $medical_order_id;
    public ?string $date;
    public ?array $files;
    public ?int $medical_status_id;

    protected array $rules = [
        'employee_id' =>'required|exists:employees,id',
        'medical_order_id' =>'required|exists:medical_orders,id',
        'date' => 'required|string',
        'medical_status_id' => 'required|exists:medical_statuses,id',
        'files' => 'nullable|array',
        'files.*.file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:8192',
        'files.*.lang' => 'nullable|in:uz,ru',
    ];

}
