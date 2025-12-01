<div class="footer">
    <div class="footer-area">
        <div class="footer-area-content">
            <div class="container">
                <div class="row ">
                    <div class="col-md-3">
                        <div class="menu">
                            <h6>Menu</h6>
                            <ul>
                                <li><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li><a href="{{ route('frontend.contact') }}">ContactUs</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 text-center">
                        <img src="{{ asset('uploads/logo/'.$sitesettings->logo_dark) }}"
                             alt="{{ $sitesettings->site_title }}"
                             class="logo-white"/>
                        <p class="text-white text-justify mt-2">{{ $sitesettings->description }}</p>
                    </div>

                    @if ($socialmedia->count() > 0)
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow Us</h6>
                                <ul>
                                    @foreach ($socialmedia as $media)
                                        <li><a href="{{ $media->link }}" target="_blank">{{ $media->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-area-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright">
                            <p>{{ $sitesettings->copyright_text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
