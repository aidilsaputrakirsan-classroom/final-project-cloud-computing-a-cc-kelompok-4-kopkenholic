@php
    use Illuminate\Support\Facades\Schema;

    // default: koleksi kosong biar tidak error
    $socialmedia = collect();

    // Kalau ada tabel & modelnya, ambil datanya
    if (Schema::hasTable('social_media')) {
        try {
            // ganti \App\Models\SocialMedia dan nama tabel/kolom sesuai punyamu
            $socialmedia = \App\Models\SocialMedia::where('status', true)->orderBy('id', 'desc')->get();
        } catch (\Throwable $e) {
            // diamkan saja; tetap pakai koleksi kosong
        }
    }
@endphp

@if ($socialmedia->count() > 0)
<div class="card mb-3">
  <div class="card-header">Stay connected</div>
  <div class="p-3">
    <ul class="list-unstyled d-flex flex-wrap gap-2 m-0">
      @foreach ($socialmedia as $media)
        <li>
          <a href="{{ $media->link ?? '#' }}" target="_blank" rel="noopener">
            {{ $media->name ?? 'Social' }}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>
@else
{{-- Tidak ada data: tampil kosong agar landing page tetap jalan --}}
@endif
