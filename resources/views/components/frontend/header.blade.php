@php
    // Biar aman kalau $sitesettings atau $menu belum dikirim
    $ss = $sitesettings ?? null;
@endphp

<header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">
            <div class="logo">
                <a href="{{ route('frontend.home') }}">

                    {{-- Logo light (mode terang) --}}
                    <img
                        src="{{ asset('uploads/logo/' . ($ss->logo_light ?? 'default.webp')) }}"
                        alt="{{ $ss->site_title ?? config('app.name', 'KaryaSI') }}"
                        class="logo-dark"
                    />

                    {{-- Logo dark (mode gelap) --}}
                    <img
                        src="{{ asset('uploads/logo/' . ($ss->logo_dark ?? 'default.webp')) }}"
                        alt="{{ $ss->site_title ?? config('app.name', 'KaryaSI') }}"
                        class="logo-white"
                    />

                </a>
            </div>

            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('frontend.home') ? 'active' : '' }}"
                                   href="{{ route('frontend.home') }}">
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('frontend.contact') ? 'active' : '' }}"
                                   href="{{ route('frontend.contact') }}">
                                    ContactUs
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="header-right">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>

                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>

                @auth
                    <div class="botton-sub">
                        <a href="{{ route('dashboard.home') }}" class="btn-subscribe">Dashboard</a>
                    </div>
                @else
                    <div class="botton-sub">
                        <a href="{{ route('auth.login') }}" class="btn-subscribe">Log In</a>
                    </div>
                @endauth

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>
