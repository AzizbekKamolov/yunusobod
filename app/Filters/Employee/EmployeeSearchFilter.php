<?php

namespace App\Filters\Employee;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EmployeeSearchFilter implements EloquentFilterContract
{

    public function __construct(

        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('search') && $this->request->get('search')) {
            $model->where('fullname', 'like', '%' . $this->request->get('search') . '%');
            $model->orWhere('passport', 'like', '%' . $this->request->get('search') . '%');
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
