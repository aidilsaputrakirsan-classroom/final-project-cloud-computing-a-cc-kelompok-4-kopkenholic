@extends('frontend.master')

@section('title','Contact Us')
@section('content')
<div class="container py-5">
  <h1>Contact Us</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('frontend.contact.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <input name="subject" class="form-control" value="{{ old('subject') }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
      @error('message') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <button class="btn btn-primary">Send</button>
  </form>
</div>
@endsection
