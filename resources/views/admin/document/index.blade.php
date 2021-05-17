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
                <h1>Document</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Document</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Document's {{ $files->count() }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @can ('Content.category')
            <div style="padding-bottom: 20px">
                <a class="btn btn-primary waves-effect" href="{{ route('admin.file') }}">
                    <i class="fa fa-plus-square"></i>
                    <span>Add New Document</span>
                </a>
            </div>
            @endcan
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th width="15%">Title</th>
                                <th width="40%">Description</th>
                                <th width="5%">Login</th>
                                <th width="15%">Created At</th>
                                <th width="15%">Updated At</th>
                                @can ('Content.category')
                                <th width="10%">Action</th>
                                @endcan

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $key=>$file)
                            <tr>
                                <td>{{ $file->title }}</td>
                                <td>{{ $file->description }}</td>
                                <td>
                                    @if($file->login == false)
                                    <span class="badge bg-danger">No</span>
                                    @else
                                    <span class="badge bg-green">Yes</span>
                                    @endif
                                </td>
                                <td>{{ $file->created_at }}</td>
                                <td>{{ $file->updated_at }}</td>

                                @can ('Content.category')

                                <td class="text-center">
                                    <a href="{{ route('admin.document.edit',$file->id) }}" class="btn btn-warning">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    {{-- <button type="button" class="btn btn-danger confirm">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                    <button class="btn btn-danger waves-effect" type="button" onclick="deleteFiles({{ $file->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $file->id }}" action="{{ route('admin.document.destroy',$file->id) }}" method="POST" style="display: none;">
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
    function deleteFiles(id) {
        swal({
            title: 'Are you sure ?'
            , text: "Once deleted, you will not be able to recover this Files !"
            , type: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonClass: 'btn btn-success'
            , cancelButtonClass: 'btn btn-danger'
            , buttonsStyling: true
            , reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled'
                    , 'Your data is safe !'
                    , 'error'
                )
            }
        })
    }

</script>
@endsection

