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
    public function __construct() {}

    public function render(): View|string
    {
        // Site settings (boleh null di Blade)
        $sitesettings = SiteSetting::first();

        // Social media: aman kalau tabel/model belum ada
        $socialmedia = collect();
        if (class_exists(SocialMedia::class) && Schema::hasTable('social_media')) {
            $socialmedia = SocialMedia::where('status', true)->orderBy('id', 'ASC')->get();
        }

        // Menu footer: fallback ke header_menu kalau footer_menu kosong
        $menu = [];
        if (class_exists(Menu::class) && Schema::hasTable('menus')) {
            $row = Menu::query()->first();
            $raw = $row?->footer_menu ?? $row?->header_menu ?? null;

            if (is_string($raw)) {
                $decoded = json_decode($raw, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $menu = array_values($decoded);
                }
            } elseif (is_array($raw)) {
                $menu = array_values($raw);
            }
        }

        return view('components.frontend.footer', compact('sitesettings', 'socialmedia', 'menu'));
    }
}
