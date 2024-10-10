<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected array $permissions = [
        ["name" => "permissions.index", "guard_name" => "web",],
        ["name" => "permissions.store", "guard_name" => "web",],
        ["name" => "permissions.update", "guard_name" => "web",],
        ["name" => "permissions.delete", "guard_name" => "web",],

        ["name" => "roles.index", "guard_name" => "web",],
        ["name" => "roles.store", "guard_name" => "web",],
        ["name" => "roles.update", "guard_name" => "web",],
        ["name" => "roles.delete", "guard_name" => "web",],

        ["name" => "users.index", "guard_name" => "web",],
        ["name" => "users.store", "guard_name" => "web",],
        ["name" => "users.update", "guard_name" => "web",],
        ["name" => "users.delete", "guard_name" => "web",],

        ["name" => "sliders.index", "guard_name" => "web",],
        ["name" => "sliders.store", "guard_name" => "web",],
        ["name" => "sliders.update", "guard_name" => "web",],
        ["name" => "sliders.delete", "guard_name" => "web",],

        ["name" => "directions.index", "guard_name" => "web",],
        ["name" => "directions.store", "guard_name" => "web",],
        ["name" => "directions.update", "guard_name" => "web",],
        ["name" => "directions.delete", "guard_name" => "web",],

        ["name" => "employees.index", "guard_name" => "web",],
        ["name" => "employees.store", "guard_name" => "web",],
        ["name" => "employees.update", "guard_name" => "web",],
        ["name" => "employees.delete", "guard_name" => "web",],

        ["name" => "social_networks.index", "guard_name" => "web",],
        ["name" => "social_networks.store", "guard_name" => "web",],
        ["name" => "social_networks.update", "guard_name" => "web",],
        ["name" => "social_networks.delete", "guard_name" => "web",],

        ["name" => "pages.index", "guard_name" => "web",],
        ["name" => "pages.store", "guard_name" => "web",],
        ["name" => "pages.update", "guard_name" => "web",],
        ["name" => "pages.delete", "guard_name" => "web",],

        ["name" => "settings.index", "guard_name" => "web",],
        ["name" => "settings.store", "guard_name" => "web",],
        ["name" => "settings.update", "guard_name" => "web",],
        ["name" => "settings.delete", "guard_name" => "web",],

        ["name" => "partners.index", "guard_name" => "web",],
        ["name" => "partners.store", "guard_name" => "web",],
        ["name" => "partners.update", "guard_name" => "web",],
        ["name" => "partners.delete", "guard_name" => "web",],

        ["name" => "requests.index", "guard_name" => "web",],
        ["name" => "requests.store", "guard_name" => "web",],
        ["name" => "requests.update", "guard_name" => "web",],
        ["name" => "requests.delete", "guard_name" => "web",],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission){
            if (!Permission::query()->where('name', $permission['name'])->exists()){
                Permission::query()->create($permission);
            }
        }
    }
}
