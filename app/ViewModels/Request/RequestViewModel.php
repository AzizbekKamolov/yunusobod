<?php
declare(strict_types=1);

namespace App\ViewModels\Request;

use Akbarali\ViewModel\BaseViewModel;

class RequestViewModel extends BaseViewModel
{
    public int $id;
    public ?string $fio;
    public ?string $email;
    public ?string $phone;
    public ?string $title;
    public ?string $content;
    public ?int $status;
    public ?string $created_at;

    protected function populate(): void
    {
        if ($this->created_at) {
            $this->created_at = date("d.m.Y H:i", strtotime($this->created_at));
        }
    }
}
