<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // aman: kosongkan dulu biar tidak dobel
        Menu::truncate();

        Menu::create([
            'header_menu' => json_encode([
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'About', 'url' => '/about'],
                ['label' => 'Posts', 'url' => '/posts'],
                ['label' => 'Contact', 'url' => '/contact'],
            ]),
        ]);
    }
}
