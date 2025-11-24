<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    {{-- === FIX TITLE ERROR === --}}
    @php
        use Illuminate\Support\Facades\Schema;

        $siteTitle = config('app.name', 'KaryaSI App'); // default dari APP_NAME
        try {
            if (class_exists(\App\Models\SiteSetting::class) && Schema::hasTable('site_settings')) {
                $siteTitle = optional(\App\Models\SiteSetting::select('site_title')->first())->site_title ?? $siteTitle;
            }
        } catch (\Throwable $e) {
            // Abaikan error jika tabel belum ada
        }
    @endphp

    <title>@yield('title', 'Dashboard') - {{ $siteTitle }}</title>

    {{-- ===== CSS ASSETS ===== --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/jqvmap/jqvmap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminlte.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.min.css') }}"/>

    @yield('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        {{-- PRELOADER --}}
        <div class="preloader flex-column justify-content-center align-items-center">
            <span class="fa-2x brand-text font-weight-bold px-2">{{ $siteTitle }}</span>
        </div>

        {{-- NAVBAR & SIDEBAR --}}
        @include('dashboard.inc.navbar')
        @include('dashboard.inc.sidebar')

        {{-- MAIN CONTENT --}}
        @yield('content')

        {{-- FOOTER --}}
        @include('dashboard.inc.footer')
    </div>

    {{-- ===== JS ASSETS ===== --}}
    <script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button) </script>
    <script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/dist/js/adminlte.js') }}"></script>

    @yield('script')
</body>
</html>
