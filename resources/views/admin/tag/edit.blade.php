@extends('layouts.backend.app')

@section('title','Tag')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Tag</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li>
            <li class="breadcrumb-item active">Tag Edit</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.tag.update',$tag->id) }}" method="POST">
            <div class="card-body">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Tag Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $tag->name }}">
                </div>

                <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">Back</a>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
            </div>
        </form>
    </div>
</section>

@endsection
