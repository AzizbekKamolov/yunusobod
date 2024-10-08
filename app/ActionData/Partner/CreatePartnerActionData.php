<?php
declare(strict_types = 1);
namespace App\ActionData\Partner;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreatePartnerActionData extends ActionDataBase
{
    public ?string $name;
    public ?UploadedFile $photo = null;
    public ?array $about;
    public ?bool $status = true;

    protected array $rules = [
        'name' => "required|string",
        'photo' => "required|mimes:jpeg,png,jpg,gif,svg|max:10000",
    ];
}
