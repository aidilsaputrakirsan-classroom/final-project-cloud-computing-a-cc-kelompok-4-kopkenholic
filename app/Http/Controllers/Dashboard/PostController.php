<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
<<<<<<< Updated upstream
use App\helpers\ActivityLogger; // ⬅️ TAMBAHAN: logger aktivitas
=======
use App\Helpers\ActivityLogger;

>>>>>>> Stashed changes

class PostController extends Controller
{
    public function index() {
        if (Auth::user()->role == 3) {
            $posts = Post::with(["category", "tags", "user"])
                ->withCount(["comments"])
                ->orderBy("id", "DESC")
                ->paginate(20);
        } else {
            $posts = Post::with(["category", "tags", "user"])
                ->withCount(["comments"])
                ->orderBy("id", "DESC")
                ->where("user_id", Auth::id())
                ->paginate(20);
        }
        return view("dashboard.post.index", compact("posts"));
    }

    public function create() {
        $categories = Category::where("status", true)->orderBy("title", "ASC")->get();
        $tags = Tag::orderBy("name", "ASC")->get();
        return view("dashboard.post.add", compact("categories", "tags"));
    }

    public function store(Request $request) {
<<<<<<< Updated upstream
        $validated = $request->validate([
            "title" => ["required", "string"],
            "slug" => ["required", "string", "unique:posts,slug"],
            "content" => ["required", "string"],
            "category" => ["required", "exists:categories,id"],
            "tags" => ["nullable", "array"],
            "featured" => ["nullable", Rule::in(["0", "1"])],
            "comment" => ["nullable", Rule::in(["0", "1"])],
            "status" => ["required", Rule::in(["0", "1"])],
            "thumbnail" => ["required", "image"],
        ]);

        $image = $request->file("thumbnail");
        $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
        $image->move(public_path("uploads/post"), $imageName);

        $post = Post::create([
            "user_id" => Auth::user()->id,
            "title" => $validated["title"],
            "slug" => Str::slug($validated["slug"]),
            "category_id" => $validated["category"],
            "content" => $validated["content"],
            "thumbnail" => $imageName,
            "is_featured" => Arr::has($validated, "featured"),
            "enable_comment" => Arr::has($validated, "comment"),
            "status" => Auth::user()->role == 1 ? "0" : $validated["status"],
        ]);

        if (Arr::has($validated, "tags")) {
            foreach ($validated["tags"] as $tag) {
                $tag = Tag::firstOrCreate(["name" => Str::lower($tag)]);
                $post->tags()->attach([$tag->id]);
            }
        }

        // 📝 LOG: CREATE POST
        ActivityLogger::log(
            'create',
            'Membuat post: ' . $post->title,
            $post->id
        );

        return redirect()->route("dashboard.posts.index")->with("success", "Post created!");
=======
    $validated = $request->validate([
        "title" => ["required", "string"],
        "slug" => ["required", "string", "unique:posts,slug"],
        "content" => ["required", "string"],
        "category" => ["required", "exists:categories,id"],
        "tags" => ["nullable", "array"],
        "featured" => ["nullable", Rule::in(["0", "1"])],
        "comment" => ["nullable", Rule::in(["0", "1"])],
        "status" => ["required", Rule::in(["0", "1"])],
        "thumbnail" => ["required", "image"],
    ]);

    $image = $request->file("thumbnail");
    $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
    $image->move(public_path("uploads/post"), $imageName);

    $post = Post::create([
        "user_id"        => Auth::user()->id,
        "title"          => $validated["title"],
        "slug"           => Str::slug($validated["slug"]),
        "category_id"    => $validated["category"],
        "content"        => $validated["content"],
        "thumbnail"      => $imageName,
        "is_featured"    => Arr::has($validated, "featured"),
        "enable_comment" => Arr::has($validated, "comment"),
        "status"         => Auth::user()->role == 1 ? "0" : $validated["status"],
    ]);

    if (Arr::has($validated, "tags")) {
        foreach ($validated["tags"] as $tag) {
            $tag = Tag::firstOrCreate(["name" => Str::lower($tag)]);
            $post->tags()->attach([$tag->id]);
        }
>>>>>>> Stashed changes
    }

    // === LOG AKTIVITAS ===
    ActivityLogger::log(
        'post.create',
        'Membuat post baru dengan judul: '.$post->title
    );

    return redirect()
        ->route("dashboard.posts.index")
        ->with("success", "Post created!");
}


    public function edit($id) {
        $post = Post::with(["tags"])->withCount(["tags"])->find($id);
        if ($post && Gate::allows("update-post", $post)) {
            $categories = Category::where("status", true)->orderBy("title", "ASC")->get();
            $tags = Tag::orderBy("name", "ASC")->get();
            return view("dashboard.post.edit", compact("post", "categories", "tags"));
        }
        return back()->withErrors("Post not exists!");
    }

    public function update(Request $request, $id) {
<<<<<<< Updated upstream
        $post = Post::find($id);
        if ($post && Gate::allows("update-post", $post)) {
            $validated = $request->validate([
                "title" => ["required", "string"],
                "slug" => ["required", "string", Rule::unique("posts", "slug")->ignore($post->id)],
                "content" => ["required", "string"],
                "category" => ["required", "exists:categories,id"],
                "tags" => ["nullable", "array"],
                "featured" => ["nullable", Rule::in(["0", "1"])],
                "comment" => ["nullable", Rule::in(["0", "1"])],
                "status" => ["required", Rule::in(["0", "1"])],
                "thumbnail" => ["nullable", "image"],
            ]);

            $post->title = $validated["title"];
            $post->slug = Str::slug($validated["slug"]);
            $post->category_id = $validated["category"];
            $post->content = $validated["content"];
            $post->is_featured = Arr::has($validated, "featured");
            $post->enable_comment = Arr::has($validated, "comment");
            $post->status = Auth::user()->role == 1 ? "0" : $validated["status"];

            if ($request->hasFile("thumbnail")) {
                $image = $request->file("thumbnail");
                $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
                $image->move(public_path("uploads/post"), $imageName);
                if (File::exists(public_path("uploads/post/".$post->thumbnail))) {
                    File::delete(public_path("uploads/post/".$post->thumbnail));
                }
                $post->thumbnail = $imageName;
            }

            $post->save();

            if (Arr::has($validated, "tags")) {
                $tagArr = [];
                foreach ($validated["tags"] as $tag) {
                    $tag = Tag::firstOrCreate(["name" => Str::lower($tag)]);
                    $tagArr[] = $tag->id;
                }
                $post->tags()->sync($tagArr);
            } else {
                $post->tags()->sync([]);
            }

            // 📝 LOG: UPDATE POST
            ActivityLogger::log(
                'update',
                'Mengedit post: ' . $post->title,
                $post->id
            );

            return redirect()->route("dashboard.posts.index")->with("success", "Post updated!");
=======
    $post = Post::find($id);

    if ($post && Gate::allows("update-post", $post)) {
        $validated = $request->validate([
            "title" => ["required", "string"],
            "slug" => ["required", "string", Rule::unique("posts", "slug")->ignore($post->id)],
            "content" => ["required", "string"],
            "category" => ["required", "exists:categories,id"],
            "tags" => ["nullable", "array"],
            "featured" => ["nullable", Rule::in(["0", "1"])],
            "comment" => ["nullable", Rule::in(["0", "1"])],
            "status" => ["required", Rule::in(["0", "1"])],
            "thumbnail" => ["nullable", "image"],
        ]);

        $post->title          = $validated["title"];
        $post->slug           = Str::slug($validated["slug"]);
        $post->category_id    = $validated["category"];
        $post->content        = $validated["content"];
        $post->is_featured    = Arr::has($validated, "featured");
        $post->enable_comment = Arr::has($validated, "comment");
        $post->status         = Auth::user()->role == 1 ? "0" : $validated["status"];

        if ($request->hasFile("thumbnail")) {
            $image = $request->file("thumbnail");
            $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
            $image->move(public_path("uploads/post"), $imageName);

            if (File::exists(public_path("uploads/post/".$post->thumbnail))) {
                File::delete(public_path("uploads/post/".$post->thumbnail));
            }

            $post->thumbnail = $imageName;
>>>>>>> Stashed changes
        }

        $post->save();

        if (Arr::has($validated, "tags")) {
            $tagArr = [];
            foreach ($validated["tags"] as $tag) {
                $tag = Tag::firstOrCreate(["name" => Str::lower($tag)]);
                $tagArr[] = $tag->id;
            }
            $post->tags()->sync($tagArr);
        } else {
            $post->tags()->sync([]);
        }

        // === LOG AKTIVITAS ===
        ActivityLogger::log(
            'post.update',
            'Mengubah post dengan judul: '.$post->title
        );

        return redirect()
            ->route("dashboard.posts.index")
            ->with("success", "Post updated!");
    }

    return back()->withErrors("Post not exists!");
}


    public function destroy($id) {
<<<<<<< Updated upstream
        $post = Post::find($id);
        if ($post && Gate::allows("update-post", $post)) {

            // 📝 LOG: SOFT DELETE POST
            ActivityLogger::log(
                'delete',
                'Menghapus (soft delete) post: ' . $post->title,
                $post->id
            );

            $post->delete();
            return back()->with("success", "Post deleted!");
        }
        return back()->withErrors("Post not exists!");
=======
    $post = Post::find($id);

    if ($post && Gate::allows("update-post", $post)) {
        $title = $post->title;

        $post->delete();

        // === LOG AKTIVITAS ===
        ActivityLogger::log(
            'post.soft_delete',
            'Memindahkan post ke trash dengan judul: '.$title
        );

        return back()->with("success", "Post deleted!");
>>>>>>> Stashed changes
    }

    return back()->withErrors("Post not exists!");
}


    public function status($id) {
    $post = Post::find($id);

    if ($post && Gate::allows("update-post", $post)) {
        if (Auth::user()->role == 1) {
            return back()->withErrors("You can't update status!");
        }

        $post->status = $post->status ? "0" : "1";
        $post->save();

        $alert = $post->status ? "Post published!" : "Post drafted!";

        // === LOG AKTIVITAS ===
        $statusText = $post->status ? 'Published' : 'Draft';
        ActivityLogger::log(
            'post.toggle_status',
            'Mengubah status post "'.$post->title.'" menjadi '.$statusText
        );

        return back()->with("success", $alert);
    }

    return back()->withErrors("Post not exists!");
}


    public function featured($id) {
    $post = Post::find($id);

    if ($post) {
        $post->is_featured = $post->is_featured ? "0" : "1";
        $post->save();

        $alert = $post->is_featured ? "Post added to featured!" : "Post removed from featured!";

        // === LOG AKTIVITAS ===
        $featuredText = $post->is_featured ? 'ditandai sebagai featured' : 'dihapus dari featured';
        ActivityLogger::log(
            'post.toggle_featured',
            'Post "'.$post->title.'" '.$featuredText
        );

        return back()->with("success", $alert);
    }

    return back()->withErrors("Post not exists!");
}


    public function comment($id) {
    $post = Post::find($id);

    if ($post && Gate::allows("update-post", $post)) {
        $post->enable_comment = $post->enable_comment ? "0" : "1";
        $post->save();

        $alert = $post->enable_comment ? "Post comment enabled!" : "Post comment disabled!";

        // === LOG AKTIVITAS ===
        $commentText = $post->enable_comment ? 'Komentar diaktifkan' : 'Komentar dinonaktifkan';
        ActivityLogger::log(
            'post.toggle_comment',
            $commentText.' untuk post "'.$post->title.'"'
        );

        return back()->with("success", $alert);
    }

<<<<<<< Updated upstream
=======
    return back()->withErrors("Post not exists!");
}




>>>>>>> Stashed changes
    public function trashed()
    {
        if (Auth::user()->role == 3) {
            // Admin (role 3): lihat semua post yang dihapus
            $posts = Post::onlyTrashed()
                ->with(['category', 'tags', 'user'])
                ->withCount('comments')
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } else {
            // User biasa: hanya lihat post miliknya yang dihapus
            $posts = Post::onlyTrashed()
                ->with(['category', 'tags', 'user'])
                ->withCount('comments')
                ->where('user_id', Auth::id())
                ->orderBy('id', 'DESC')
                ->paginate(20);
        }

        return view('dashboard.post.trashed', compact('posts'));
    }

<<<<<<< Updated upstream
    public function restore($id) {
        $post = Post::onlyTrashed()->find($id);
        if ($post && Gate::allows("update-post", $post)) {
            if ($post->category()->withTrashed()->first()->deleted_at) {
                return back()->withErrors("Restore the category first!");
            }
            $post->restore();

            // 📝 LOG: RESTORE POST
            ActivityLogger::log(
                'restore',
                'Restore post: ' . $post->title,
                $post->id
            );

            return back()->with("success", "Post restored!");
=======
    return view('dashboard.post.trashed', compact('posts'));
}


   public function restore($id) {
    $post = Post::onlyTrashed()->find($id);

    if ($post && Gate::allows("update-post", $post)) {
        if ($post->category()->withTrashed()->first()->deleted_at) {
            return back()->withErrors("Restore the category first!");
>>>>>>> Stashed changes
        }

        $post->restore();

        // === LOG AKTIVITAS ===
        ActivityLogger::log(
            'post.restore',
            'Mengembalikan post dari trash dengan judul: '.$post->title
        );

        return back()->with("success", "Post restored!");
    }

    return back()->withErrors("Post not exists!");
}


    public function delete($id) {
<<<<<<< Updated upstream
        $post = Post::onlyTrashed()->find($id);
        if ($post && Gate::allows("update-post", $post)) {

            // 📝 LOG: FORCE DELETE POST
            ActivityLogger::log(
                'force-delete',
                'Menghapus permanen post: ' . $post->title,
                $post->id
            );

            if (File::exists(public_path("uploads/post/".$post->thumbnail))) {
                File::delete(public_path("uploads/post/".$post->thumbnail));
            }
            $post->tags()->sync([]);
            $post->comments()->forceDelete();
            $post->forceDelete();
            return back()->with("success", "Post deleted!");
=======
    $post = Post::onlyTrashed()->find($id);

    if ($post && Gate::allows("update-post", $post)) {
        $title = $post->title;

        if (File::exists(public_path("uploads/post/".$post->thumbnail))) {
            File::delete(public_path("uploads/post/".$post->thumbnail));
>>>>>>> Stashed changes
        }

        $post->tags()->sync([]);
        $post->comments()->forceDelete();
        $post->forceDelete();

        // === LOG AKTIVITAS ===
        ActivityLogger::log(
            'post.force_delete',
            'Menghapus permanen post dengan judul: '.$title
        );

        return back()->with("success", "Post deleted!");
    }

<<<<<<< Updated upstream
}
=======
    return back()->withErrors("Post not exists!");
}


}
>>>>>>> Stashed changes
