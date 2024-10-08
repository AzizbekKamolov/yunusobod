<?php
declare(strict_types = 1);
namespace App\ActionData\Partner;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class updatePartnerActionData extends ActionDataBase
{
    public ?string $name;
    public ?UploadedFile $photo = null;
    public ?array $about;
    public ?bool $status = true;

    protected array $rules = [
        'name' => "required|string",
        'about' => "nullable|array",
        'photo' => "nullable|mimes:jpeg,png,jpg,gif,svg|max:10000",
    ];
}
