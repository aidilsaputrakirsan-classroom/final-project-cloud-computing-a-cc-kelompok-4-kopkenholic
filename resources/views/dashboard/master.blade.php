<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    @php
        use Illuminate\Support\Facades\Schema;

        $siteTitle = config('app.name', 'KaryaSI App');
        try {
            if (class_exists(\App\Models\SiteSetting::class) && Schema::hasTable('site_settings')) {
                $siteTitle = optional(\App\Models\SiteSetting::select('site_title')->first())->site_title ?? $siteTitle;
            }
        } catch (\Throwable $e) {
        }
    @endphp

    <title>@yield('title', 'Dashboard') - {{ $siteTitle }}</title>

    {{-- CORE CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- CSS tambahan per-halaman --}}
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    {{-- OPTIONAL: kalau merasa preloader bikin ribet, boleh dihapus --}}
    {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <span class="fa-2x brand-text font-weight-bold px-2">{{ $siteTitle }}</span>
    </div> --}}

    @include('dashboard.inc.navbar')
    @include('dashboard.inc.sidebar')

    @yield('content')

    @include('dashboard.inc.footer')
</div>

{{-- CORE JS --}}
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/dist/js/adminlte.js') }}"></script>

{{-- JS tambahan per-halaman --}}
@stack('scripts')
</body>
</html>
