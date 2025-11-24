@php
    use App\Models\Post;
    use Illuminate\Support\Facades\Schema;

    $q = Post::where('status', true);

    if (Schema::hasColumn('posts', 'views')) {
        $q->orderBy('views', 'desc');
    } else {
        // fallback aman kalau kolom 'views' belum ada
        $q->orderBy('id', 'desc');   // atau ->latest()
    }

    $__popular = $q->limit(5)->get();
@endphp
