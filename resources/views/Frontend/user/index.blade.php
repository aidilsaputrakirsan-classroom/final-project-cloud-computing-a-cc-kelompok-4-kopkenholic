@extends('frontend.master')

@section('title', $title)

@section('content')
@include('frontend.user.inc.author')

<section class="blog-author mt-30">
  <div class="container-fluid">
    <div class="row">
      @include('frontend.user.inc.post')
      @include('frontend.user.inc.sidebar')
    </div>
  </div>
</section>
@endsection
