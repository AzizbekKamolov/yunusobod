<?php
declare(strict_types=1);
namespace App\ActionData\Employee;


use Akbarali\ActionData\ActionDataBase;
use Illuminate\Http\UploadedFile;

class CreateEmployeeActionData extends ActionDataBase
{
    public ?int $id;
    public ?string $fullname;
    public ?string $pinfl;
    public ?string $birthdate;
    public ?string $passport;
    public ?string $username;
    public ?string $password;
    public ?int $branch_id;
    public ?int $position_id;
    public ?UploadedFile $photo;
    protected function prepare(): void
    {

        $this->rules = [
            'fullname' => ['required','string','max:255'],
            'username' => ['required','string','max:255','unique:employees,username'],
            'password' => ['required','string','min:8','max:255'],
            'pinfl' => ['required','string','max:255'],
            'passport' => ['required','string','max:10','min:10'],
            'birthdate' => ['required',],
            'branch_id' => ['required','exists:branches,id'],
            'position_id' => ['required','exists:positions,id'],
            'photo' => ['nullable','file','mimes:jpeg,png,jpg,gif,svg'],
        ];
    }

}
