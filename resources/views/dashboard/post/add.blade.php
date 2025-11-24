@extends('dashboard.master')
@section('title', 'New Post')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.posts.index") }}">All Posts</a></li>
                        <li class="breadcrumb-item active">New Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Post</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <form action="{{ route("dashboard.posts.store") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" value="{{ old('slug') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content" placeholder="Write content">{{ old('content') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category" style="width: 100%;">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old("category") ? (old("category") == $category->id ? "selected" : "") : "" }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
              <div class="form-group">
  <label for="tags" class="font-weight-semibold">Tags</label>
  <select
    id="tags"
    name="tags[]"
    class="form-control form-control-lg select2bs4"
    multiple="multiple"
    data-placeholder="Tambahkan atau pilih tag..."
    style="width: 100%; border: 1px solid #ced4da; border-radius: .25rem;">
      @foreach ($tags as $tag)
        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
      @endforeach
  </select>
  <small class="text-muted">
    Tekan <b>Enter</b> atau <b>Koma (,)</b> untuk menambah tag baru.
  </small>
</div>


                                        <div class="form-group">
                                            <label for="thumbnail">Thumbnail</label>
                                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*"/>
                                            <img id="thumbnailpreview" class="img-fluid img-thumbnail mt-3 d-none"/>
                                        </div>
                                        <div class="align-items-center d-flex form-group justify-content-between">
                                            <label for="featured">Featured</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="featured" id="featured" value="1"/>
                                                <label for="featured"></label>
                                            </div>
                                        </div>
                                        <div class="align-items-center d-flex form-group justify-content-between">
                                            <label for="comment">Enable Comment</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="comment" id="comment" value="1" checked/>
                                                <label for="comment"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                @if (auth()->user()->role != 1)
                                                <option value="1">Publish</option>
                                                @endif
                                                <option value="0">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Publish</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("style")
<link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/select2/css/select2.min.css") }}"/>
<link rel="stylesheet" href="{{ asset("assets/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}"/>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/sweetalert2/sweetalert2.all.js") }}"></script>
<script src="{{ asset("assets/dashboard/plugins/select2/js/select2.full.min.js") }}"></script>
<script>
  $(document).ready(function() {

    // Fungsi bikin slug sendiri, tanpa plugin
    function makeSlug(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            // buang aksen (kalau ada)
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            // ganti selain huruf/angka jadi -
            .replace(/[^a-z0-9]+/g, '-')
            // hapus - dobel di awal/akhir
            .replace(/^-+|-+$/g, '');
    }

    // Auto isi slug saat title diketik
    $('#title').on('input', function () {
        const title = $(this).val();
        $('#slug').val(makeSlug(title));
    });

    $('#category').select2({
        theme: 'bootstrap4'
    });

    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        width: '100%',
        theme: 'bootstrap4',
        dropdownParent: $('#tags').closest('.form-group')
    });

    $("#content").summernote({
        placeholder: 'Write content...',
        height: 170,
    });

    function readURL(input) {
        if (input.files && input.files[0] && input.files[0].type.includes("image")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnailpreview').removeClass("d-none");
                $('#thumbnailpreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $("#thumbnail").val('');
            $('#thumbnailpreview').addClass("d-none");
            Swal.fire({
                icon: "error",
                text: "Select a valid image!"
            });
        }
    }

    $("#thumbnail").change(function(){
        readURL(this);
    });
});

</script>
<script>
(function () {
  function initTags() {
    if (!window.jQuery) return console.error('jQuery not found');
    if (!$.fn.select2) {
      // Load Select2 dari CDN bila plugin lokal gagal
      var css = document.createElement('link');
      css.rel = 'stylesheet';
      css.href = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css';
      document.head.appendChild(css);

      var css2 = document.createElement('link');
      css2.rel = 'stylesheet';
      css2.href = 'https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.6.2/dist/select2-bootstrap4.min.css';
      document.head.appendChild(css2);

      var js = document.createElement('script');
      js.src = 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js';
      js.onload = initTags; // init setelah CDN selesai
      document.head.appendChild(js);
      return;
    }
    var $el = $('#tags');
    if (!$el.length) return console.error('#tags element not found');

    $el.select2({
      tags: true,
      tokenSeparators: [',', ';'],
      width: '100%',
      theme: 'bootstrap4',
      dropdownParent: $el.closest('.form-group'),
      placeholder: 'Select tag'
    });
    console.log('Select2 ready on #tags');
  }
  document.addEventListener('DOMContentLoaded', initTags);
})();
</script>

@endsection

