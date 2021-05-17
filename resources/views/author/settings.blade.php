@extends('layouts.backend.app')

@section('title','Settings')

@section('content')
<section class="content" style="padding-top: 15px">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/profile/'.Auth::user()->image) }}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">{{ Auth::user()->username }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>My Role</b> <a class="float-right">{{$roles}}</a>
                </li>
                </ul>

                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> About</strong>

                <p class="text-muted">
                    {{ Auth::user()->about }}
                </p>

                <hr>

                <strong><i class="fas fa-envelope"></i> Email</strong>

                <p class="text-muted">                    
                    {{ Auth::user()->email }}
                </p>

                <hr>

                <strong><i class="fas fa-phone"></i> Phone</strong>

                <p class="text-muted">
                    {{ Auth::user()->phone }}
                </p>

                {{-- <hr> --}}

                {{-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Setting</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Password</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    {{-- <form method="POST" action="{{ route('author.profile.image') }}" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="image" class="form-control" placeholder="Enter your email address" name="image" value="{{ Auth::user()->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-warning float-right">Update</button>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">
                    <form method="POST" action="{{ route('author.password.update') }}" class="form-horizontal">
                        @csrf
                        @method('PUT')
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-warning float-right">Update</button>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                    <form method="POST" action="{{ route('author.profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" placeholder="Enter your name" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="username" class="form-control" placeholder="Enter your username" name="username" value="{{ Auth::user()->username }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email_address">Email Address</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" class="form-control" placeholder="Enter your email address" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="phone">Phone</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="phone" class="form-control" placeholder="Enter your email address" name="phone" value="{{ Auth::user()->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="about">About</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="5" name="about" class="form-control">{{ Auth::user()->about }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file" id="image" placeholder="Enter your email address" name="image" value="{{ Auth::user()->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-warning float-right">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
@endsection


