@extends('layouts.backend.app')

@section('title')
Permission
@endsection

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Permission</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Permission</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Permission's  {{ $permission->count() }}</h3>
        </div>
        <!-- /.card-header -->
                <div class="card-body">
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                                    @role('super admin')
                                    <div style="padding-bottom: 20px">
                                        <a class="btn btn-primary waves-effect" href="{{ route('admin.permission.create') }}" >
                                            <i class="fa fa-plus-square"></i>
                                            <span>Add New Permission</span>
                                        </a>
                                    </div>
                                    @endrole
                                    <tr>
                                        <th>NO</th>
                                        <th>PERMISSIONS</th>
                                        <th>GROUP NAME</th>
                                        <th>GUARD NAME</th>
                                        <th>DATE CREATED</th>
                                        @role ('super admin')
                                        <th>ACTION</th>
                                        @endrole
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($permission as $permission)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->group_name}}</td>
                                        <td>{{$permission->guard_name}}</td>
                                        <td>{{$permission->created_at}}</td>
                                        @role ('super admin')
                                        <td>
                                            <a href="{{ route('admin.permission.edit',$permission->id) }}" class="btn btn-warning waves-effect">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <button class="btn btn-danger waves-effect" type="button" onclick="deletePermission({{ $permission->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $permission->id }}" action="{{ route('admin.permission.destroy',$permission->id) }}" method="POST" style="display: none;">
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
    function deletePermission(id) {
        swal({
            title: 'Are you sure ?',
            text: "Once deleted, you will not be able to recover this permission !",
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