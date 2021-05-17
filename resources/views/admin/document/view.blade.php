@extends('layouts.frontend.app')

@section('title','Posts')

@push('css')
<link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
<style>
    .favorite_posts {
        color: blue;
    }

</style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>Document</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">
            @forelse($posts as $post)
            @if($post->login == 1)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/document/document.png') }}" alt="{{ $post->title }}"></div>

                        <div class="blog-info">

                            {{-- <h4 class="title"><a href="{{ route('details',$post->id) }}"><b>{{ $post->title }}</b></a></h4> --}}
                            <h4 class="title"><b>{{ $post->title }}</b></h4>
                            <h6 class="description">{{ $post->description }}</h6>

                            {{-- <small class="float-right" style="padding-right: 30px">*Must login first</small> --}}
                            <ul class="post-footer" style="padding: 10px">
                                <form action="{{ route('download.login',$post->id) }}" method="GET">
                                    <button class="btn waves-effect float-right" type="submit">
                                        <i class="fa fa-download"></i>Download
                                    </button>
                                </form>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->

            @endif
            @if($post->login == 0)

            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/document/document.png') }}" alt="{{ $post->title }}"></div>

                        <div class="blog-info">

                            {{-- <h4 class="title"><a href="{{ route('details',$post->id) }}"><b>{{ $post->title }}</b></a></h4> --}}
                            <h4 class="title"><b>{{ $post->title }}</b></h4>
                            <h6 class="description">{{ $post->description }}</h6>

                            <ul class="post-footer" style="padding: 10px">
                                <form action="{{ route('download',$post->id) }}" method="GET">
                                    <button class="btn waves-effect float-right" type="submit">
                                        <i class="fa fa-download"></i>Download
                                    </button>
                                </form>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endif
            @empty
            <div class="col-lg-12 col-md-12">
                <div class="card h-100">
                    <div class="single-post post-style-1 p-2">
                        <strong>No Post Found :(</strong>
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforelse
        </div><!-- row -->

        {{-- {{ $posts->links() }} --}}

    </div><!-- container -->
</section><!-- section -->

@endsection

@push('js')

@endpush

