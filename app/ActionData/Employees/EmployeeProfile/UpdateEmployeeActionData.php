<?php

namespace App\ActionData\Employees\EmployeeProfile;

use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class UpdateEmployeeActionData extends ActionDataBase
{

    public ?int $id;
    public ?string $fullname;
    public ?string $username;
    public ?string $password;
    public ?UploadedFile $photo;

    protected function prepare(): void
    {

        $this->rules = [
            'fullname' => ['required','string','max:255'],
            'username' => ['required','string','max:255'],
            'password' => ['nullable','string','min:8','max:255'],
            'photo' => ['nullable','file','mimes:jpeg,png,jpg,gif,svg'],
        ];
    }
}
