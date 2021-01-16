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
        <h1>Edit Post</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li>
            <li class="breadcrumb-item active">Post Edit</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                        @csrf
                        @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Featured Image</label>
                        <br>
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $post->status == true ? 'checked' : '' }}>
                        <label for="publish">Publish</label>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                            <label for="category">Select Category</label>
                            <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true">
                                @foreach($categories as $category)
                                    <option
                                        @foreach($post->categories as $postCategory)
                                            {{ $postCategory->id == $category->id ? 'selected' : '' }}
                                        @endforeach
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                            <label for="tag">Select Tags</label>
                            <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                @foreach($tags as $tag)
                                    <option
                                            @foreach($post->tags as $postTag)
                                                {{ $postTag->id == $tag->id ? 'selected' :'' }}
                                            @endforeach
                                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="body" id="body">{{ $post->body }}</textarea>
                    </div>

                    <div class="form-group">
                        <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </div>
				</div>
                    </form>
                        <!-- ckeditor    -->
                    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace( 'body' );
                </script>
    </div>
</section>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
@endpush