<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SiteSetting; // <-- tambahkan ini
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(string $username)
    {
        // pastikan user ketemu atau 404 (lebih rapi)
        $user = User::query()
            ->where('status', true)
            ->where('username', $username)
            ->firstOrFail();

        // ambil postingan user yang publish/aktif
        $posts = $user->posts()
            ->with('category')
            ->where('status', true)
            ->orderByDesc('id')
            ->paginate(10);

        // ambil site settings untuk judul
        $site = SiteSetting::query()->first();
        $title = $user->name . ' - ' . ($site->site_title ?? config('app.name', 'KaryaSI App'));

        return view('frontend.user.index', [
            'user'          => $user,
            'posts'         => $posts,
            'sitesettings'  => $site,
            'title'         => $title,
        ]);
    }
}
