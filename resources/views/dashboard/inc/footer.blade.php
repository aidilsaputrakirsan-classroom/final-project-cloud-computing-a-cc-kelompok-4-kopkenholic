<div class="footer">
    <div class="footer-area">
        <div class="footer-area-content">
            <div class="container">
                <div class="row">

                    {{-- ===== Menu (aman walau $menu tidak ada) ===== --}}
                    @php
                        $rawMenu   = (isset($menu) && is_iterable($menu)) ? $menu : [];
                        $menuItems = collect($rawMenu)->map(function ($item) {
                            return [
                                'href' => $item['href'] ?? ($item->href ?? $item->url ?? '#'),
                                'text' => $item['text'] ?? ($item->text ?? $item->label ?? $item->title ?? 'Link'),
                            ];
                        });
                    @endphp

                    @if ($menuItems->isNotEmpty())
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Menu</h6>
                                <ul>
                                    @foreach ($menuItems as $item)
                                        <li><a href="{{ $item['href'] }}">{{ $item['text'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- ===== Logo + Deskripsi (fallback aman) ===== --}}
                    <!-- @php
                        $site        = $sitesettings ?? null;
                        $siteTitle   = optional($site)->site_title ?? config('app.name', 'KaryaSI App');
                        $logoDark    = optional($site)->logo_dark ?: 'logo_light.png';
                        $description = trim(optional($site)->description ?? '');
                    @endphp

                    <div class="col-md-6 text-center">
                        <img src="{{ asset('uploads/logo/'.$logoDark) }}"
                             alt="{{ $siteTitle }}" class="logo-white"/>
                        @if ($description !== '')
                            <p class="text-white text-justify mt-2">{{ $description }}</p>
                        @endif
                    </div> -->

                    {{-- ===== Social media (aman walau $socialmedia tidak ada) ===== --}}
                    @php
                        $rawSoc   = (isset($socialmedia) && is_iterable($socialmedia)) ? $socialmedia : [];
                        $socItems = collect($rawSoc)->map(function ($m) {
                            return [
                                'link' => $m->link ?? ($m['link'] ?? '#'),
                                'name' => $m->title ?? ($m['title'] ?? 'Social'),
                            ];
                        });
                    @endphp

                    @if ($socItems->isNotEmpty())
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow Us</h6>
                                <ul>
                                    @foreach ($socItems as $m)
                                        <li><a href="{{ $m['link'] }}" target="_blank" rel="noopener">{{ $m['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- ===== Copyright ===== --}}
        @php
            $copyright = trim(optional($site)->copyright_text ?? '');
            if ($copyright === '') {
                $copyright = '© '.date('Y').' '.$siteTitle;
            }
        @endphp

        <div class="footer-area-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright">
                            <p>{{ $copyright }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
