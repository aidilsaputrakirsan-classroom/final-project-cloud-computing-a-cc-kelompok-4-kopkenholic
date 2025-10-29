<?php

namespace App\View\Components\Frontend;

use App\Models\Menu;
use App\Models\SiteSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Ambil pengaturan situs (bisa null kalau belum ada)
        $sitesettings = SiteSetting::first();

        // Ambil menu pertama, pastikan tidak null agar tidak error
        $menuRecord = Menu::first();

        // Jika menu ada, decode JSON-nya; kalau tidak, jadikan array kosong
        $menu = $menuRecord ? json_decode($menuRecord->header_menu, true) : [];

        // Kirim data ke view
        return view('components.frontend.header', compact('sitesettings', 'menu'));
    }
}
