<?php

namespace App\Filters\Branch;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class BranchFilter 
{
    public function handle(Builder $query, Closure $next): mixed
    {
        $next($query)->where(function ($query) {
            if (request()->has('search') and request()->get('search')) {
                $query->whereAny([
                    'name',
                    'address',
                ], 'LIKE', '%'. request('search'). '%'  );
            }
        });
        return $next($query);
    }
}