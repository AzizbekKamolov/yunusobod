<?php
declare(strict_types=1);

namespace App\ViewModels\Employee;

use Akbarali\ViewModel\BaseViewModel;
use Illuminate\Support\Carbon;

class EmployeeViewModel extends BaseViewModel
{
    public int $id;
    public string $fio;
    public string $photo;
    public int $direction_id;
    public int $experience;
    public array $about;
    public ?string $aboutH;
    public ?string $about_uz;
    public ?string $about_ru;
    public ?string $about_en;
    public bool $status;
    public ?string $statusName;
    public int $order;
    public ?string $created_at = '';
    public ?string $updated_at;

    protected function populate(): void
    {
        if ($this->created_at) {
            $this->created_at = date("Y-m-d", strtotime($this->created_at));
        }
        $this->statusName = $this->status ? trans('form.active') : trans('form.inactive');
    $this->aboutH = $this->trans($this->about);
    $this->about_ru = $this->trans($this->about, 'ru');
    $this->about_en = $this->trans($this->about, 'en');
    $this->about_uz = $this->trans($this->about, 'uz');
    }
}
