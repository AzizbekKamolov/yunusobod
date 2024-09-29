<?php

namespace Database\Seeders;

use App\Models\SocialNetworkModel;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    protected array $socialNetworks = [
        [
            'name' => 'Facebook',
            'icon' => '<i class="fa-brands fa-facebook"></i>',
        ],
        [
            'name' => 'Twitter',
            'icon' => '<i class="fa-brands fa-twitter"></i>',
        ],
        [
            'name' => 'Telegram',
            'icon' => '<i class="fa-brands fa-telegram"></i>',
        ],
        [
            'name' => 'Instagram',
            'icon' => '<i class="fa-brands fa-instagram"></i>',
        ],
        [
            'name' => 'Youtube',
            'icon' => '<i class="fa-brands fa-youtube"></i>',
        ],
        [
            'name' => 'Linkedin',
            'icon' => '<i class="fa-brands fa-linkedin"></i>',
        ],
        [
            'name' => 'Email',
            'icon' => '<i class="fa-solid fa-envelope"></i>',
        ],
    ];

    public function run(): void
    {
        foreach ($this->socialNetworks as $socialNetwork) {
            if (!SocialNetworkModel::query()->where('name', $socialNetwork['name'])->exists()) {
                $socialNetworkData = SocialNetworkModel::query()->create($socialNetwork);
                $socialNetworkData->update(['order' => $socialNetworkData->id]);
            }
        }
    }
}
