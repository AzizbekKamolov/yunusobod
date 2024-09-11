<?php

namespace App\Filters\Employee;

use App\Filters\EloquentFilterContract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmployeeFilter implements EloquentFilterContract
{

    public function __construct(

        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('fullname') && $this->request->get('fullname')) {
            $model->where('fullname', 'like', '%' . $this->request->get('fullname') . '%');
        }
        if ($this->request->has('passport')) {
            $model->where('passport', 'like', '%' . $this->request->get('passport') . '%');
        }
        if($this->request->has('department_id') && $this->request->get('department_id')){
             $model->where('department_id', $this->request->get('department_id'));
        }
        if($this->request->has('branch_id')){
             $model->where('branch_id', $this->request->get('branch_id'));
        }
        if($this->request->has('position_id') && $this->request->get('position_id')){
             $model->where('position_id', $this->request->get('position_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
