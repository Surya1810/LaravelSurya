@extends('layouts.backend.app')

@section('title','Category')

@push('css')

@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Category</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Category Edit</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            {{-- @method('PUT') --}}
            <div class="form-group form-float">
                <div class="form-line">
                    <label class="form-label">Category Name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                </div>
            </div>

            <div class="form-group">
                <input type="file" name="image">
            </div>

            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }}">Back</a>
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
        </div>
        </form>
    </div>
</section>
@endsection

@push('script')

@endpush