@extends('layouts.backend.app')

@section('title','Post')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Favorite</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Favorite</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Favorite's {{ Auth::user() ->favorite_posts()->count() }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Favorite</th>
                                    {{--<th><i class="material-icons">comment</i><</th>--}}
                                    <th>View</th>
                                    @role('super admin')
                                    <th>Action</th>
                                    @endrole
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,'10') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->favorite_to_users->count() }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            @role('super admin')
                                            <td class="text-center">

                                                <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <button class="btn btn-danger waves-effect" type="button" onclick="removePost({{ $post->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="remove-form-{{ $post->id }}" action="{{ route('post.favorite',$post->id) }}" method="POST" style="display: none;">
                                                    @csrf
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
        function removePost(id) {
            swal({
                title: 'Are you sure ?',
                text: "Once deleted, you will not be able to recover this favorite !",
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