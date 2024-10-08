<?php

namespace Database\Seeders;

use App\Models\PageModel;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    protected array $pages = [
        [
            "action" => "about_us",
        ],
        [
            "action" => "activity",
        ],
        [
            "action" => "our_teams",
        ],
        [
            "action" => "statistics",
        ],
        [
            "action" => "our_partners",
        ],
        [
            "action" => "contact_us",
        ],
    ];

    public function run(): void
    {
        foreach ($this->pages as $page) {
            if (!PageModel::query()->where('action', $page['action'])->exists()){
                PageModel::query()->create($page);
            }
        }
    }
}
