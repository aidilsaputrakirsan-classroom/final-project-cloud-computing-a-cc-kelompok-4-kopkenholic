@php
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    // default kosong agar aman
    $tags = $tags ?? collect();

    // Jika tidak dikirim dari luar, coba ambil sendiri dari DB (kalau tabel/model ada)
    if ($tags->isEmpty() && Schema::hasTable('tags')) {
        try {
            $tags = \App\Models\Tag::orderBy('name')->limit(15)->get();
        } catch (\Throwable $e) {
            $tags = collect();
        }
    }
@endphp

<div class="widget-title"><h5>Tags</h5></div>

<div class="widget-tags">
  <ul class="list-inline">
    @forelse ($tags as $tag)
      @php
        $slug = $tag->slug ?? Str::slug($tag->name ?? '');
        $url  = Route::has('frontend.tag') && $slug ? route('frontend.tag', $slug) : '#';
      @endphp
      <li><a href="{{ $url }}">{{ $tag->name ?? 'Tag' }}</a></li>
    @empty
      {{-- biarkan kosong agar landing page tetap jalan --}}
    @endforelse
  </ul>
</div>
