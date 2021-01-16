@extends('layouts.backend.app')

@section('title','Permission')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Permission</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Permission</a></li>
            <li class="breadcrumb-item active">Permission Edit</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="/permission/{{$permission->id}}/update" method="POST">
            <div class="card-body">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $permission->name }}" name="name" placeholder="Enter a Permission Name">
                        </div>

                        <div class="form-group">
                            <label for="group_name">Group Name</label>
                            <input type="text" class="form-control" id="guard_name" value="{{ $permission->group_name }}" name="group_name" placeholder="Enter a Permission Guard Name">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                    </div>
                    </form>
                </div>
            </section>
@endsection