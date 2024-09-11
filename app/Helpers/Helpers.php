<?php

namespace App\Helpers;
if (!function_exists('employee')) {
    function employee(): \Illuminate\Contracts\Auth\Authenticatable|\App\Models\Employee
    {
        return auth('employee')->user();
    }
}
