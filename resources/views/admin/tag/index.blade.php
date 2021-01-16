@extends('layouts.backend.app')

@section('title','Tag')

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
        <h1>Tag</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Tag</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Tag's {{ $tags->count() }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @role('super admin')
        <div style="padding-bottom: 20px">
            <a class="btn btn-primary waves-effect" href="{{ route('admin.tag.create') }}" >
                <i class="fa fa-plus-square"></i>
                <span>Add New Tag</span>
            </a>
        </div>
            @endrole
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="text-uppercase">
                        <tr>
                            <th>Name</th>
                            <th>Post Count</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $key=>$tag)
                                <tr>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->posts->count() }}</td>
                                    <td>{{ $tag->created_at }}</td>
                                    <td>{{ $tag->updated_at }}</td>
                                    @role('super admin')
                                    <td class="text-center">
                                        <a href="{{ route('admin.tag.edit',$tag->id) }}" class="btn btn-warning waves-effect">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <button class="btn btn-danger waves-effect" type="button" onclick="deleteTag({{ $tag->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $tag->id }}" action="{{ route('admin.tag.destroy',$tag->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    @endrole
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
    function deleteTag(id) {
        swal({
            title: 'Are you sure ?',
            text: "Once deleted, you will not be able to recover this tag !",
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