@extends('layouts.backend.app')

@section('title','User')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">User</a></li>
            <li class="breadcrumb-item active">User Edit</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user.update',$user->id) }}" method="POST">
                {{csrf_field()}}
                <label>Role</label>
            
            <div class="form-group">
                <select name="role" class="form-control">
                    <option selected disabled>Nothing Selected</option>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder=" Enter Your Name" value="{{$user->name}}" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputUsername1" placeholder=" Enter Your Username"value="{{$user->username}}" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your E-mail"value="{{$user->email}}" disabled>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPhone1" class="col-form-label">Phone Number</label>
                <input name="phone" class="form-control" type="tel" id="exampleInputPhone1" placeholder=" Enter Your Phone Number" value="{{$user->phone}}" disabled>
            </div>
            <div class="form-group">
                <label for="email_address_2">Profile Image</label><br>
                <input type="file" name="image" {{$user->image}} disabled>
            </div>
                <button type="submit" class="btn btn-warning btn-primary">Update</button>
            </form>
        </div>
    </div>

@stop
