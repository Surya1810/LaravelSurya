@extends('layouts.backend.app')

@section('title','Tag')

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Create Tag</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li>
            <li class="breadcrumb-item active">Tag Create</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.tag.store') }}" method="POST">
    <div class="card-body">
            @csrf
            <div class="form-group">
                <label class="form-label">Tag Name</label>
                <input type="text" id="name" class="form-control" name="name">
            </div>

            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">Back</a>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
    </div>
        </form>
    </div>
</section>


@endsection