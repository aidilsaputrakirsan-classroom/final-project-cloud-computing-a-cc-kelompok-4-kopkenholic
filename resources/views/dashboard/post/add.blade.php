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
                            {{-- ERROR --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    @foreach ($errors->all() as $error)
                                        <p class="m-0">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            {{-- SUCCESS --}}
                            @if (session("success"))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    <p class="m-0">{{ session("success") }}</p>
                                </div>
                            @endif

                            {{-- FORM MULAI DI SINI --}}
                            <form action="{{ route('dashboard.posts.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    {{-- KOLOM KIRI --}}
                                    <div class="col-md-8">

                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input
                                                type="text"
                                                id="title"
                                                name="title"
                                                class="form-control"
                                                placeholder="Enter title"
                                                value="{{ old('title') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input
                                                type="text"
                                                id="slug"
                                                name="slug"
                                                class="form-control"
                                                placeholder="Enter slug"
                                                value="{{ old('slug') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea
                                                id="content"
                                                name="content"
                                                class="form-control"
                                                placeholder="Write content">{{ old('content') }}</textarea>
                                        </div>

                                    </div>

                                    {{-- KOLOM KANAN --}}
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select id="category" name="category" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ old('category') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- TAGS: INPUT + CHIP --}}
                                        <div class="form-group">
                                            <label for="tag-input">Tags</label>

                                            {{-- container chip --}}
                                            <div id="tags-chips"
                                                 class="border rounded p-2 mb-2"
                                                 style="min-height: 38px; cursor: text;"
                                                 onclick="document.getElementById('tag-input').focus()">
                                                {{-- chip akan ditambahkan lewat JS --}}
                                            </div>

                                            {{-- input untuk ketik tag --}}
                                            <input
                                                type="text"
                                                id="tag-input"
                                                class="form-control"
                                                placeholder="Ketik tag lalu tekan Enter atau koma">

                                            <small class="text-muted">
                                                Ketik satu tag, lalu tekan <b>Enter</b> atau <b>Koma (,)</b> untuk menambah tag baru.
                                            </small>
                                        </div>

                                        <div class="form-group">
                                            <label for="thumbnail">Thumbnail</label>
                                            <input type="file"
                                                   id="thumbnail"
                                                   name="thumbnail"
                                                   class="form-control"
                                                   accept="image/*">
                                            <img id="thumbnailpreview"
                                                 class="img-fluid img-thumbnail mt-3 d-none">
                                        </div>

                                        <div class="d-flex justify-content-between form-group">
                                            <label for="featured">Featured</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="featured" name="featured" value="1">
                                                <label for="featured"></label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between form-group">
                                            <label for="comment">Enable Comment</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="comment" name="comment" value="1" checked>
                                                <label for="comment"></label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                @if (auth()->user()->role != 1)
                                                    <option value="1">Publish</option>
                                                @endif
                                                <option value="0">Draft</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                {{-- TOMBOL PUBLISH (DALAM FORM) --}}
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Publish
                                    </button>
                                </div>

                            </form>
                            {{-- FORM SELESAI DI SINI --}}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/dashboard/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

<script>
$(function () {

    // ===== AUTO SLUG DARI TITLE =====
    function makeSlug(text){
        return text.toString().toLowerCase().trim()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    $('#title').on('input', function () {
        $('#slug').val(makeSlug($(this).val()));
    });

    // ===== SUMMERNOTE CONTENT (kalau plugin ada) =====
    if (typeof $('#content').summernote === 'function') {
        $('#content').summernote({
            placeholder: 'Write content...',
            height: 170
        });
    }

    // ===== THUMBNAIL PREVIEW =====
    $('#thumbnail').on('change', function () {
        if (this.files && this.files[0] && this.files[0].type.includes("image")) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnailpreview')
                    .attr('src', e.target.result)
                    .removeClass('d-none');
            };
            reader.readAsDataURL($('#thumbnail')[0].files[0]);
        } else {
            $('#thumbnail').val('');
            $('#thumbnailpreview').addClass('d-none');
            Swal.fire({
                icon: "error",
                text: "Select a valid image!"
            });
        }
    });

    // ===== TAGS SIMPLE CHIP (TANPA SELECT2) =====
    const tagsSet = new Set();
    const $chips  = $('#tags-chips');
    const $input  = $('#tag-input');

    function addTag(raw) {
        let name = (raw || '').trim().replace(/,$/, '');
        if (!name) return;

        let key = name.toLowerCase();
        if (tagsSet.has(key)) return;

        tagsSet.add(key);

        const $chip   = $('<span class="badge badge-primary mr-1 mb-1"></span>');
        const $label  = $('<span></span>').text(name);
        const $remove = $('<a href="#" class="text-white ml-1">&times;</a>');
        const $hidden = $('<input type="hidden" name="tags[]">').val(name);

        $remove.on('click', function (e) {
            e.preventDefault();
            $chip.remove();
            tagsSet.delete(key);
        });

        $chip.append($label).append($remove).append($hidden);
        $chips.append($chip);
    }

    $input.on('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTag($input.val());
            $input.val('');
        }
    });
});
</script>
@endpush
