@extends('layouts.frontend.app')

@section('title','Posts')

@push('css')
    <link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>About</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">
        <div class="row">
            <div class="single-post post-style-1">
            <h2>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sint, alias quos quod eum ipsum minus, 
                dignissimos natus maiores voluptatibus accusantium aut voluptates aspernatur. Eveniet sunt porro ex facere nulla. Enim.
            </h2>
            </div>
        </div>
    </div>
</section>
@endsection