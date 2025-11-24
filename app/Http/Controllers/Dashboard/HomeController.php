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
        $user = auth()->user();   // user yang lagi login

        // ====== ADMIN (role = 3) ======
        if ($user->role == 3) {
            $posts      = Post::count();
            $users      = User::count();
            $categories = Category::count();
            $messages   = ContactMessage::count();

            $comments   = Schema::hasTable('comments')
                            ? DB::table('comments')->count()
                            : 0;
        } 
        // ====== USER BIASA (role = 1) ======
       else {
    // Hitung jumlah POST milik user yang login
    $posts = Post::where('user_id', $user->id)->count();

    // Hitung komentar di SEMUA post yang dimiliki user itu
    if (Schema::hasTable('comments')) {
        // ambil semua id post milik user
        $userPostIds = Post::where('user_id', $user->id)->pluck('id');

        $comments = DB::table('comments')
                    ->whereIn('post_id', $userPostIds)
                    ->count();
    } else {
        $comments = 0;
    }

    // ini nggak dipakai di view untuk user
    $users      = null;
    $categories = null;
    $messages   = null;
}


        return view('dashboard.home.index', compact(
            'posts', 'comments', 'users', 'categories', 'messages', 'user'
        ));
    }
}
