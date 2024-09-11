<?php

namespace App\Services;

use App\ActionData\User\LoginUserActionData;
use App\DataObjects\Auth\AuthDataObject;
use App\Exceptions\OperationException;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public static function login(LoginUserActionData $data): bool
    {
        $user = User::query()->where('username', $data->username)->first();
        if (is_null($user) || !Hash::check($data->password, $user->password)) {
            return false;
        }
        Auth::login($user);
        return true;
    }

    public function loginEmployee(LoginUserActionData $data): bool
    {
        $employee = Employee::query()->where('username', $data->username)->first();
        if (is_null($employee) || !Hash::check($data->password, $employee->password)) {
            return false;
        }
        Auth::guard('employee')->attempt($data->all());

        return true;
    }
}
