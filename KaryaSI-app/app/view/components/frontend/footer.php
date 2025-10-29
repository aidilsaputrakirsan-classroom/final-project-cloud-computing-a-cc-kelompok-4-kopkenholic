<?php

namespace App\View\Components\Frontend;

use App\Models\Menu;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;

class Footer extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|string
    {
        // Site settings (boleh null di Blade)
        $sitesettings = SiteSetting::first();

        // Social media (aman kalau tabelnya belum ada)
        $socialmedia = collect();
        if (class_exists(SocialMedia::class) && Schema::hasTable('social_media')) {
            $socialmedia = SocialMedia::where('status', true)->orderBy('id')->get();
        }

        // Ambil menu footer, fallback ke header_menu jika kosong
        $menu = [];
        if (class_exists(Menu::class) && Schema::hasTable('menus')) {
            $row = Menu::query()->first();

            $raw = $row?->footer_menu ?: $row?->header_menu;

            // Decode → array
            $arr = is_string($raw) ? json_decode($raw, true) : (is_array($raw) ? $raw : []);
            $arr = is_array($arr) ? array_values($arr) : [];

            // Normalisasi: pastikan setiap item punya 'label' & 'href'
            $menu = collect($arr)->map(function ($it) {
                $it = is_array($it) ? $it : [];
                return [
                    'label' => $it['label'] ?? ($it['text'] ?? 'Menu'),
                    'href'  => $it['href']  ?? ($it['url'] ?? '#'),
                ];
            })->all();
        }

        return view('components.frontend.footer', compact('sitesettings', 'socialmedia', 'menu'));
    }
}
