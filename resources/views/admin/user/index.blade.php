@extends('layouts.backend.app')

@section('title','User')

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">user's  {{ $data_users->count() }}</h3>
        </div>
        <!-- /.card-header -->
                <div class="card-body">
                    @role('super admin')
                    <div style="padding-bottom: 20px">
                        <a class="btn btn-primary waves-effect" href="{{ route('admin.user.create') }}" >
                            <i class="fa fa-plus-square"></i>
                            <span>Add New User</span>
                        </a>
                    </div>
                        @endrole
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                        <tr>
                            <th>NO</th>
                            <th>NAME</th>
                            <th>USERNAME</th>
                            <th>PHONE NUMBER</th>
                            <th>EMAIL ADDRESS</th>
                            <th>ROLES</th>
                    @role('super admin')
                            <th>ACTION</th>
                    @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_users as $user)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            @foreach ($user->roles as $role)
                            <td>{{$role->name}}</td>
                            @endforeach
                            @role('super admin')
                            <td class="text-center">
                                <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-warning waves-effect">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>

                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteUser({{ $user->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.user.destroy',$user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            @endrole
                        </tr>
                        @endforeach

                        </tr>
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
    function deleteUser(id) {
        swal({
            title: 'Are you sure ?',
            text: "Once deleted, you will not be able to recover this user !",
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