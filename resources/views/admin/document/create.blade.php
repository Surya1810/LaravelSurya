@extends('layouts.backend.app')

@section('title','Document')

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Upload File</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    {{-- <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Tag</a></li> --}}
                    <li class="breadcrumb-item active">File Upload</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.file.upload') }}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" id="title" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <input type="text" id="description" class="form-control" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                    <label class="form-label">File</label>
                    <input type="file" id="file" name="file">
                </div>

                {{-- <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.tag.index') }}">Back</a> --}}
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Upload</button>
            </div>
        </form>
    </div>
</section>


@endsection

