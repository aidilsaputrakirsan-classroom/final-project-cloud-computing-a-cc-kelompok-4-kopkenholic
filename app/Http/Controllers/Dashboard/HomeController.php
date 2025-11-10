<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari tabel yang sudah ada
        $posts = Post::count();
        $users = User::count();
        $categories = Category::count();
        $messages = ContactMessage::count();

        // Karena fitur komentar belum aktif, kita aman-kan
        // Jika tabel comments belum ada, set 0
        $comments = Schema::hasTable('comments') ? DB::table('comments')->count() : 0;

        // Kirim data ke view dashboard
        return view("dashboard.home.index", compact("posts", "comments", "users", "categories", "messages"));
    }
}
