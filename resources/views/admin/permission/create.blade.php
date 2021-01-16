@extends('layouts.backend.app')

@section('title','Permission')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Create Permission</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.permission.index') }}">Permission</a></li>
            <li class="breadcrumb-item active">Permission Create</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.permission.store') }}" method="POST">
            <div class="card-body">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInputPermissionName">Permission</label>
                    <input name="name" type="text" class="form-control" id="exampleInputPermission_Name" placeholder=" Enter Your Permission">
                </div>
                <div class="form-group">
                    <label for="exampleInputPermissionName">Guard Name</label>
                    <input name="guard_name" type="text" class="form-control" id="exampleInputPermission_Name" placeholder=" Enter Your Guard Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputGroupName">Group Name</label>
                    <input name="group_name" type="text" class="form-control" id="exampleInputGroupName" placeholder=" Enter Your Group Name">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" href="/dashboard">Back</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</section>

@endsection