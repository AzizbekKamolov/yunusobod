<?php

namespace App\Filters\Accident;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AccidentRecordFilter implements EloquentFilterContract
{

    public function __construct(

        protected Request $request
    )
    {
    }

    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('accident_type_id') && $this->request->get('accident_type_id')) {
            $model->where('accident_type_id', '=', $this->request->get('accident_type_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
