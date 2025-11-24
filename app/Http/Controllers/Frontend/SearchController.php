<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // jika tidak ada query, kembali ke home
        if (!$request->q) {
            return redirect()->route('frontend.home');
        }

        $query = $request->q;

        $posts = Post::with('category')
            ->where('status', true)                // hanya post yang aktif
            ->where(function ($q) use ($query) {   // kelompokkan kondisi pencarian
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.search.index', compact('posts', 'query'));
    }
}
