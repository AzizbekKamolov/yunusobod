<?php
declare(strict_types = 1);
namespace App\ActionData\SocialNetwork;

use Akbarali\ActionData\ActionDataBase;

class UpdateSocialNetworkActionData extends ActionDataBase
{
    public ?string $name;
    public ?string $icon;
    public ?string $url;
    public bool $status = false;

    protected array $rules = [
        'name' => "required|string",
        'icon' => "required|string",
        'status' => "required|bool",
    ];
}
