<header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">

            {{-- ====== Logo aman dengan fallback ====== --}}
            @php
                $site       = $sitesettings ?? null;
                $siteTitle  = optional($site)->site_title ?? config('app.name', 'KaryaSI App');
                $logoLight  = optional($site)->logo_light ?: 'default-light.png';
                $logoDark   = optional($site)->logo_dark  ?: 'default-dark.png';
            @endphp

            <div class="logo">
                <a href="{{ route('frontend.home') }}">
                    <img src="{{ asset('uploads/logo/' . $logoLight) }}"
                         alt="{{ $siteTitle }}" class="logo-dark"/>
                    <img src="{{ asset('uploads/logo/' . $logoDark) }}"
                         alt="{{ $siteTitle }}" class="logo-white"/>
                </a>
            </div>

            {{-- ====== Navbar ====== --}}
            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        @php
                            $items = is_iterable($menu ?? []) ? $menu : [];
                            $hasMenu = is_countable($items) ? count($items) > 0 : false;
                            $currentUrl = url()->current();
                        @endphp

                        @if ($hasMenu)
                            <ul class="navbar-nav">
                                @foreach ($items as $item)
                                    @php
                                        $href = $item['href'] ?? ($item->href ?? $item->url ?? '#');
                                        $text = $item['text'] ?? ($item->text ?? $item->label ?? $item->title ?? 'Link');
                                        $isActive = rtrim($currentUrl, '/') === rtrim(url($href), '/');
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link{{ $isActive ? ' active' : '' }}" href="{{ $href }}">
                                            {{ $text }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </nav>
            </div>

            {{-- ====== Header kanan (theme, search, login/dashboard) ====== --}}
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

                {{-- Tombol login atau dashboard --}}
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
