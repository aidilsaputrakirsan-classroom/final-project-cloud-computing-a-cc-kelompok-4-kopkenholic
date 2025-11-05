<div class="widget">
    <div class="widget-title">
        <h5>Search</h5>
    </div>
    <div class="widget-search">
        <form action="{{ route("frontend.search") }}">
            <input type="search" value="{{ request()->route()->getName() == "frontend.search" ? request()->q : "" }}" id="gsearch" name="q" placeholder="Search...">
            <button type="submit" class="btn-submit"><i class="las la-search"></i></button>
        </form>
    </div>
</div>
<form action="#" method="GET" class="mb-3">
  <div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="Search...">
    <button class="btn btn-primary" type="submit">Go</button>
  </div>
</form>
