<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => "superadmin",
            'username' => "superadmin",
            'email' => 'username@gmail.com',
            'password' => bcrypt("superadmin")
        ];
        $newUser = User::query()->where('username', $user['username'])->first();
        if (!$newUser){
            $newUser = User::query()->create($user);
        }
        $newUser->syncRoles(Role::all());
    }
}
