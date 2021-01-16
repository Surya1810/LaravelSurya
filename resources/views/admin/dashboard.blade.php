@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
@include('sweetalert::alert')
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
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $user->count() }}</h3>

                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-friends"></i>
                    </div>
                    <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-cyan">
                    <div class="inner">
                        <h3>{{ $role->count() }}</h3>

                        <p>Total Roles</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.role.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $permission->count() }}</h3>

                        <p>Total Permissions</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('admin.permission.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{ $subscribers->count() }}</h3>

                        <p>Total Subscribers</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-youtube"></i>
                    </div>
                    <a href="{{ route('admin.subscriber.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="info-box shadow">
                    <span class="info-box-icon bg-success"><i class="fa fa-book-open"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Posts</span>
                        <span class="info-box-number">{{ $posts->count() }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-success"><i class="fa fa-book"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending Post</span>
                        <span class="info-box-number">{{ $total_pending_posts }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-success"><i class="fa fa-list"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Categories</span>
                        <span class="info-box-number">{{ $category_count }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-success"><i class="fa fa-tags"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Tag</span>
                        <span class="info-box-number">{{ $tag_count }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-success"><i class="far fa-eye"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Views</span>
                        <span class="info-box-number">{{ $all_views }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-pink"><i class="far fa-heart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Favorite</span>
                        <span class="info-box-number">{{ $all_views }}</span>
                    </div>
                </div>
                <div class="info-box shadow">
                    <span class="info-box-icon bg-blue"><i class="fa fa-calendar-day"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Today Author</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">MOST POPULAR POST</h3>
                    </div>
                    <div class="card-body">
                        <div class="single-table">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead class="text-uppercase">
                                    <tr>
                                        <th>Rank</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,'20') }}</td>
                                            <td>{{ $post->user->name }}</td>
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
                                            <td>
                                                <a class="btn btn-sm btn-primary waves-effect" target="_blank" href="{{ route('post.details',$post->slug) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>TOP 10 ACTIVE AUTHOR</h2>
                    </div>
                    <div class="card-body">
                        <div class="single-table">
                            <div class="table-responsive">
                                <table class="table table-hover text-center">
                                    <thead class="text-uppercase">
                                    <tr>
                                    <th>Rank List</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($active_authors as $key=>$author)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->posts_count }}</td>
                                            <td>{{ $author->comments_count }}</td>
                                            <td>{{ $author->favorite_posts_count }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
@endsection

@push('js')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="assets/backend/plugins/flot-charts/jquery.flot.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="assets/backend/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="assets/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush