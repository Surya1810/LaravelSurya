@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
    </div>
</section>
<section class="content">   
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-cyan">
                    <div class="inner">
                        <h3>{{ $posts->count() }}</h3>

                        <p>Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book-open"></i>
                    </div>
                    <a href="{{ route('author.post.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-pink">
                    <div class="inner">
                        <h3>{{ Auth::user() ->favorite_posts()->count()}}</h3>

                        <p>Favorites</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-heart"></i>
                    </div>
                    <a href="{{ route('author.favorite.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $total_trashed }}</h3>

                        <p>Post Trashed</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-trash"></i>
                    </div>
                    <a href="{{ route('author.comment.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $all_views }}</h3>

                        <p>Views</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-eye"></i>
                    </div>
                    <a href="{{ route('author.post.trashed') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->


        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>TOP 5 POPULAR POSTS</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Rank List</th>
                                    <th>Title</th>
                                    <th>Views</th>
                                    <th>Favorite</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,30) }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->favorite_to_users_count }}</td>
                                            <td>{{ $post->comments_count }}</td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="badge bg-green">Published</span>
                                                @else
                                                    <span class="badge bg-yellow">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
    </div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush