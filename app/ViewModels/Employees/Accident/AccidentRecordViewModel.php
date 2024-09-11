<?php
declare(strict_types=1);
namespace App\ViewModels\Employees\Accident;

use Akbarali\ViewModel\BaseViewModel;
use Carbon\Carbon;

class AccidentRecordViewModel extends BaseViewModel
{
    public int $id;
    public ?array $name;
    public int $accident_type_id;
    public $files;
    public ?string $begin_date;
    public ?string $hname;
    public ?string $end_date;

    protected function populate():void
    {
        $this->begin_date = Carbon::parse($this->begin_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($this->end_date)->format('Y-m-d');
        $this->hname = $this->trans($this->name);
    }
}
