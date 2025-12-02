@extends("frontend.master")

@section("title", $post->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-image">
                    <img src="{{ asset('uploads/post/'.$post->thumbnail) }}" alt="{{ $post->title }}"/>
                </div>
                <div class="post-single-body">
                    <div class="post-single-title">
                        <h1>{{ $post->title }}</h1>

                        @php
                            // supaya aman kalau user-nya sudah dihapus
                            $author = optional($post->user);
                            $authorName = $author->name ?? 'Unknown Author';
                            $authorUsername = $author->username;
                            $authorProfile = $author->profile ?? 'default.webp';
                        @endphp

                        <ul class="entry-meta">
                            <li class="post-author-img">
                                <img src="{{ asset('uploads/author/'.$authorProfile) }}" alt="{{ $authorName }}"/>
                            </li>

                            <li class="post-author">
                                @if($authorUsername)
                                    <a href="{{ route('frontend.user', $authorUsername) }}">
                                        {{ $authorName }}
                                    </a>
                                @else
                                    <span>{{ $authorName }}</span>
                                @endif
                            </li>

                            <li class="entry-cat">
                                <a href="{{ route('frontend.category', $post->category->slug) }}" class="category-style-1 ">
                                    <span class="line"></span>{{ $post->category->title }}
                                </a>
                            </li>

                            <li class="post-date">
                                <span class="line"></span>{{ $post->created_at->format('F d, Y') }}
                            </li>
                        </ul>
                    </div>

                    <div class="post-single-content">
                        {!! $post->content !!}
                    </div>

                    <div class="post-single-bottom">
                        @if ($post->tags_count > 0)
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    @foreach ($post->tags as $tag)
                                        <li>
                                            <a href="{{ route('frontend.tag', $str::slug($tag->name)) }}">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- social media share dikomentari --}}
                    </div>

                    @include("frontend.post.inc.author")
                    @include("frontend.post.inc.comment")
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
