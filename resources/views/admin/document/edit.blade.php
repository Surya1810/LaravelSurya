@extends('layouts.backend.app')

@section('title','Category')

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Document</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.document.index') }}">Document</a></li>
                    <li class="breadcrumb-item active">Document Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.document.update',$file->id) }}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                {{-- @method('PUT') --}}
                <div class="form-group form-float">
                    <div class="form-line">
                        <label class="form-label">File Title</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $file->title }} " disabled>
                    </div>
                </div>

                {{-- <div class="card card-secondary">
                    <div class="card-body">
                        <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on" style="width: 92px;">
                            <div class="bootstrap-switch-container" style="width: 135px; margin-left: 0px;">
                                <span class="bootstrap-switch-handle-on bootstrap-switch-success" style="width: 45px;">ON</span>
                                <span class="bootstrap-switch-label" style="width: 45px;">&nbsp;</span>
                                <span class="bootstrap-switch-handle-off bootstrap-switch-danger" style="width: 45px;">OFF</span>
                                <input type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="" data-off-color="danger" data-on-color="success"></div>
                        </div>
                        <small>Choose, User must login or not to download the file</small>
                    </div>
                </div> --}}
                <div class="form-group">
                    <input type="checkbox" id="login" class="filled-in" name="login" value="1" {{ $file->login == true ? 'checked' : '' }}>
                    <label for="login">User must login to download file</label>
                </div>

                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.document.index') }}">Back</a>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('script')

@endpush

