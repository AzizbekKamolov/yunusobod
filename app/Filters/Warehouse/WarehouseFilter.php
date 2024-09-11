<?php

namespace App\Filters\Warehouse;

use App\Filters\EloquentFilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WarehouseFilter implements EloquentFilterContract
{
    public function __construct(
        protected Request $request
    )
    {
    }
    public function applyEloquent(Builder $model): Builder
    {
        if ($this->request->has('search')) {
            $model->whereRaw("LOWER(JSON_EXTRACT(name, \"$.".app()->getLocale()."\")) LIKE ?", ["%".strtolower($this->request->get('search'))."%"]);
        }
        if ($this->request->has('warehouse_category_id')) {
            $model->where('warehouse_category_id','=' , $this->request->get('warehouse_category_id'));
        }
        return $model;
    }

    public static function getRequest(Request $request): static
    {
        return new static($request);
    }
}
