<?php
declare(strict_types=1);
namespace App\ViewModels\Admin\Position;

use Akbarali\ViewModel\BaseViewModel;
use App\ViewModels\Admin\Department\DepartmentViewModel;

class PositionViewModel extends BaseViewModel
{
    public int $id;
    public array $name;
    public ?string $name_uz;
    public ?string $hname;
    public ?string $name_ru;
    public  $employees = [];
    public $department = null ;



    protected function populate():void
    {
//        dd($this);
        $this->name_uz = $this->trans($this->name, 'uz');
        $this->name_ru = $this->trans($this->name,'ru' );
        $this->hname = $this->trans($this->name);
        if($this->department){
            $this->department =  DepartmentViewModel::fromDataObject($this->department) ;
        }
        $this->employees = count($this->employees);
    }
}
