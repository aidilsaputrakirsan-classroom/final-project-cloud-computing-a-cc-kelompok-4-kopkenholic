@extends("frontend.master")

@section('title', ($settings?->site_title ?? config('app.name')) . ' - ' . ($settings?->tagline ?? ''))


@section("content")

@include('frontend.home.inc.featuredpost')
@include('frontend.home.inc.category')


<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            @include("frontend.home.inc.recentpost")
            @include("frontend.home.inc.sidebar")
        </div>
    </div>
</section>
@endsection
