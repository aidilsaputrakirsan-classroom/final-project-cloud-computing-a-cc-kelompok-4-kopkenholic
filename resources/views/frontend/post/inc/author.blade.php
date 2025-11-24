<div class="post-single-author">
    <div class="authors-info">

        @php
            $author = optional($post->user);
            $authorName = $author->name ?? 'Unknown Author';
            $authorUsername = $author->username;
            $authorProfile = $author->profile ?? 'default.webp';
        @endphp

        <div class="image">
            @if($authorUsername)
                <a href="{{ route('frontend.user', $authorUsername) }}" class="image">
                    <img src="{{ asset('uploads/author/'.$authorProfile) }}" alt="{{ $authorName }}"/>
                </a>
            @else
                <span class="image">
                    <img src="{{ asset('uploads/author/'.$authorProfile) }}" alt="{{ $authorName }}"/>
                </span>
            @endif
        </div>

        <div class="content">
            @if($authorUsername)
                <a href="{{ route('frontend.user', $authorUsername) }}">
                    <h4>{{ $authorName }}</h4>
                </a>
            @else
                <h4>{{ $authorName }}</h4>
            @endif

            @if ($author->about)
            <p>{{ $author->about }}</p>
            @endif
            <!-- <div class="social-media">
                <ul class="list-inline">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                </ul>
            </div> -->
        </div>
    </div>
</div>
