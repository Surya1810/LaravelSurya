@extends('layouts.backend.app')

@section('title','Category')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Category</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Category</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Category  {{ $categories->count() }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        @can ('Content.category')
        <div style="padding-bottom: 20px">
        <a class="btn btn-primary waves-effect" href="{{ route('admin.category.create') }}">
            <i class="fa fa-plus-square"></i>
            <span>Add New Category</span>
        </a>
        </div>
        @endcan
        <div class="single-table">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="text-uppercase">
                    <tr>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        @can ('Content.category')
                        <th>Action</th>
                        @endcan

                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key=>$category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->posts->count() }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                @can ('Content.category')
                                
                                <td class="text-center">
                                    <a href="{{ route('admin.category.edit',$category->id) }}" class="btn btn-warning">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    {{-- <button type="button" class="btn btn-danger confirm">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                    <button class="btn btn-danger waves-effect" type="button" onclick="deleteCategory({{ $category->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy',$category->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                                @endcan

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        
    <!-- /.card -->
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteCategory(id) {
            swal({
                title: 'Are you sure ?',
                text: "Once deleted, you will not be able to recover this category !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: true,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe !',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
