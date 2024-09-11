<?php
declare(strict_types=1);
namespace App\ViewModels\Admin\Organization;

use Akbarali\ViewModel\BaseViewModel;
use App\Utils\Phone;
use Carbon\Carbon;

class OrganizationViewModel extends BaseViewModel
{
    public int $id;
    public string $name;
    public string $address;
    public string $phone;
    public ?string $description;
    public ?string $hphone;
    public string $created_at;
    protected function populate():void
    {
        $this->created_at = Carbon::parse($this->created_at)->format('d-m-Y ');
        $phone = new Phone($this->phone);
        $this->hphone= $phone->format();

    }
}
