@extends('layouts.backend.app')

@section('title','Post')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Create Post</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li>
            <li class="breadcrumb-item active">Post Create</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('author.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>
                            Title
                            </h2>
                        </div>
                        <div class="card-body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="title">
                                        <label class="form-label">Post Title</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image">
                                </div>

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                                <label for="publish">Publish</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                Categories and Tags
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                                    <label for="category">Select Category</label>
                                    <select name="categories[]" id="category" class="categories form-control show-tick" data-live-search="true" placeholder="Nothing Selected">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                                    <label for="tag">Select Tags</label>
                                    <select name="tags[]" id="tag" class="tags form-control show-tick" data-live-search="true" multiple >
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('author.post.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Content</h2>
                        </div>
                        <div class="card-body">
                        <textarea class="form-control" name="body" id="body"></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </form>
                    <!-- ckeditor    -->
                    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace( 'body' );
                </script>
    </div>
@endsection

@section ('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('.tags').select2();
});</script>

<script>
    $(".categories").select2({
    placeholder: "Nothing Selected",
    allowClear: true
});
</script>
@endsection

@section ('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection