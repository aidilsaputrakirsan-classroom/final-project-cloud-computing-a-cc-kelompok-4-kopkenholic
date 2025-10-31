<footer class="main-footer">
    @php
        use Illuminate\Support\Facades\Schema;

        // Ambil judul situs dari tabel SiteSetting jika ada, fallback ke APP_NAME
        $siteTitleFooter = (class_exists(\App\Models\SiteSetting::class) && Schema::hasTable('site_settings'))
            ? optional(\App\Models\SiteSetting::select('site_title')->first())->site_title
            : null;

        // Jika tidak ada, gunakan variabel global atau nama app dari .env
        $siteTitleFooter = $siteTitleFooter ?? ($siteTitle ?? config('app.name', 'KaryaSI App'));
    @endphp

    <strong>
        Copyright &copy; 2022-{{ date('Y') }}
        <a href="{{ route('frontend.home') }}">{{ $siteTitleFooter }}</a>.
    </strong>
    All rights reserved.

    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>
