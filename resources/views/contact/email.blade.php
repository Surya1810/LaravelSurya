@extends('layouts.frontend.app')

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
    <h1 class="title display-table-cell"><b>Contact Us</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">
        <form method="POST" action="{{route('contact.submit')}}" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body row">
                    @csrf
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="">
                            <h2>Laravel<strong>Surya</strong></h2>
                            <p class="lead mb-5">Mandala Mekar, Bandung, West Java<br>
                                Phone: +62 895 1277 6878
                            </p>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label for="name" style="font-weight: bold" class="float-left">Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="Enter Your Name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email" style="font-weight: bold" class="float-left">E-Mail</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter Your E-Mail" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="subject" style="font-weight: bold" class="float-left">Subject</label>
                            <input type="text" class="form-control" name="subject" required placeholder="Enter Your Subject">
                        </div>
                        <div class="form-group">
                            <label for="message" style="font-weight: bold" class="float-left">Message</label>
                            <textarea class="form-control" name="message" required rows="7"></textarea>
                        </div>
                        <div class="margin">
                            <div class="btn-group float-right">
                                <button type="submit" class="btn btn-primary">Send message</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="https://web.whatsapp.com/">Whatsapp</a>
                                    <a class="dropdown-item" href="https://www.instagram.com/direct/inbox/">Instagram</a>
                                    <a class="dropdown-item" href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSGLPkQxMlZHTLBwdmVlzrgNtDSNJbHlzMtzTRLZggrdpStgjPNbclRqMgLBbvzHqHPDSwQZ">Gmail</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Others</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
</section><!-- section -->

@endsection

