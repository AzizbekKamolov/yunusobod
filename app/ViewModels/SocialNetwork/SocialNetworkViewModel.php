<?php
declare(strict_types=1);

namespace App\ViewModels\SocialNetwork;

use Akbarali\ViewModel\BaseViewModel;
use Illuminate\Support\Carbon;

class SocialNetworkViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public ?string $icon;
    public bool $status = true;
    public string $statusName = '';
    public ?string $url;
    public int $order;

    public string|Carbon $created_at;

    protected function populate(): void
    {
        $this->statusName = $this->status ? trans('form.active') : trans('form.inactive');
//        $this->created_at = $this->created_at->format('d-m-Y H-i');
    }
}
