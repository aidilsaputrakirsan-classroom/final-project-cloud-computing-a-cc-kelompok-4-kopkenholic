@php
  use App\Models\Category;
  $__cats = Category::where('status', true)->orderBy('title')->limit(10)->get();
@endphp

<div class="card mb-3">
  <div class="card-header">Categories</div>
  @if ($__cats->count())
    <ul class="list-group list-group-flush">
      @foreach ($__cats as $c)
        <li class="list-group-item">{{ $c->title }}</li>
      @endforeach
    </ul>
  @else
    <div class="p-3 text-muted">No categories yet.</div>
  @endif
</div>
