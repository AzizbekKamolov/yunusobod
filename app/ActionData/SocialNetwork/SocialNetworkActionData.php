<?php
declare(strict_types = 1);
namespace App\ActionData\SocialNetwork;

use Akbarali\ActionData\ActionDataBase;

class SocialNetworkActionData extends ActionDataBase
{
    public ?string $name;
    public ?string $icon;
    public ?string $url;
    public bool $status = true;
    public int $order = 1;

    protected array $rules = [
        'name' => "required|string",
        'icon' => "required|string",
    ];
}
