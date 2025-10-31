<div class="footer">
            </div>
          @endif

          <div class="col-md-6 text-center">
            <img
              src="{{ asset('uploads/logo/' . (($site->logo_dark ?? 'default-dark.png'))) }}"
              alt="{{ $site->site_title ?? config('app.name') }}"
              class="logo-white"
            />
            <p class="text-white text-justify mt-2">{{ $site->description ?? '' }}</p>
          </div>

          @if(isset($socialmedia) && method_exists($socialmedia,'count') && $socialmedia->count() > 0)
            <div class="col-md-3">
              <div class="menu">
                <h6>Follow Us</h6>
                <ul>
                  @foreach ($socialmedia as $media)
                    <li><a href="{{ $media->link }}" target="_blank" rel="noopener">{{ $media->title }}</a></li>
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
              <p>{{ $site->copyright_text ?? ('© '.date('Y').' '.($site->site_title ?? config('app.name'))) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
