<?php
declare(strict_types=1);

namespace App\ActionData\Employee;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreateEmployeeActionData extends ActionDataBase
{
    public ?string $fio;
    public ?UploadedFile $photo;
    public ?int $direction_id;
    public ?int $experience;
    public ?array $about;
    public bool $status = true;
    public int $order = 1;

    protected array $rules = [
        'about' => "required|array",
        'fio' => "required",
        'photo' => "required|image|mimes:jpeg,png,jpg,gif,svg|max:10000",
        'direction_id' => "required",
        'experience' => "required",
    ];
}
