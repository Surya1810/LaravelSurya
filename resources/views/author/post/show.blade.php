@extends('layouts.backend.app')

@section('title','Post')

@push('css')
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Show Post</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.post.index') }}">Post</a></li>
            <li class="breadcrumb-item active">Show</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
    <div class="container">
        <!-- Vertical Layout | With Floating Label -->
            <div class="card-header">
                <a href="{{ route('author.post.index') }}" class="btn btn-danger waves-effect"><i class="fas fa-arrow-left"></i>  Back</a>
        @if($post->is_approved == false)
            <button type="button" class="btn btn-warning waves-effect float-right" disabled>
                <i class="fas fa-exclamation"></i>
                <span>Pending</span>
            </button>
        @else
            <button type="button" class="btn btn-success waves-effect float-right" disabled>
                <i class="fas fa-thumbs-up"></i>
                <span>Approved</span>
            </button>
        @endif
        <br>
        <br>
        </div>

            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                {{ $post->title }}<br>
                            </h2>
                            <medium>Posted By <strong> <a>{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }}</medium>
                        </div>
                        <div class="card-body">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-header bg-cyan">
                            <h2>
                                Categories
                            </h2>
                        </div>
                        <div class="card-body">
                            @foreach($post->categories as $category)
                                <span class="badge bg-cyan">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-green">
                            <h2>
                                Tags
                            </h2>
                        </div>
                        <div class="card-body">
                            @foreach($post->tags as $tag)
                                <span class="badge bg-green">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-amber">
                            <h2>
                                Featured Image
                            </h2>
                        </div>
                        <div class="card-body">
                            <img class="img-fluid" src="{{asset('storage/post/'.$post->image) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

@endpush