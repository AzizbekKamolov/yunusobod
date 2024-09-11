<?php
declare(strict_types=1);
namespace App\ActionData\Employee;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class ImportEmployeeActionData extends ActionDataBase
{

    public ?int $position_id;
    public ?int $branch_id;

    public ?UploadedFile $file;

    protected array $rules = [
        'position_id' => 'required|int|exists:positions,id',
        'branch_id' => 'required|int|exists:branches,id',
        'file' => 'required|file'
    ];
}
