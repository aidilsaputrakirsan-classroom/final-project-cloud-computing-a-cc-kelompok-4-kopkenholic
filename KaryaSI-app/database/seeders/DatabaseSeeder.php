<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            "name" => "Admin",
            "username" => "admin",
            "email" => "admin@admin.com",
            "role" => 3,
            "password" => "admin",
        ]);

        // \App\Models\Category::create([
        //     "title" => "Uncategorized",
        //     "slug" => "uncategorized",
        // ]);

        \App\Models\SiteSetting::create([
            "site_title" => "KaryaSI",
            "tagline" => "Website Untuk Menampilkan Karya Mahasiswa Sistem Informasi!",
            "description" => "KaryaSI adalah platform digital yang dikembangkan untuk menampilkan dan mendokumentasikan karya mahasiswa Program Studi Sistem Informasi Institut Teknologi Kalimantan. Website ini berfungsi sebagai media publikasi, inspirasi, dan kolaborasi bagi mahasiswa untuk menampilkan hasil proyek, penelitian, dan inovasi di bidang teknologi informasi.",
            "logo_dark" => "logo_dark.png",
            "logo_light" => "logo_light.png",
            "copyright_text" => "© 2025, KaryaSI, All Rights Reserved.",
            "enable_registration" => "1",
        ]);

        \App\Models\Menu::create([
            "header_menu" => json_encode([["href"=>"http://127.0.0.1:8000/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"AboutUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"ContactUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"PrivacyPolicy","tooltip"=>"","children"=>[]]]),
            "footer_menu" => json_encode([["href"=>"http://127.0.0.1:8000/","icon"=>"","text"=>"Home","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"AboutUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"ContactUs","tooltip"=>"","children"=>[]],["href"=>"#","icon"=>"","text"=>"PrivacyPolicy","tooltip"=>"","children"=>[]]]),
        ]);
    }
}
