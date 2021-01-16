@extends('layouts.backend.app')

@section('title','Post')

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Post</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Post</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Post's {{ $posts->count() }}</h3>
        </div>
        <!-- /.card-header -->
                <div class="card-body">
            @role('super admin')
                <div style="padding-bottom: 20px">
                    <a class="btn btn-primary waves-effect" href="{{ route('admin.post.create') }}">
                        <i class="fa fa-plus-square"></i>
                        <span>Add New Post</span>
                    </a>
                </div>
            @endrole
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>View</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    @role ('super admin')
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
                                            <td>{{ $post->view_count }}</td>
                                            <td>
                                                @if($post->is_approved == true)
                                                    <span class="badge bg-blue">Approved</span>
                                                @else
                                                    <span class="badge bg-yellow">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($post->status == true)
                                                    <span class="badge bg-green">Published</span>
                                                @else
                                                    <span class="badge bg-yellow">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            {{--<td>{{ $post->updated_at }}</td>--}}
                                    @role ('super admin')
                                            <td class="text-center">
                                                <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-warning waves-effect">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a href="{{ route('admin.post.destroy',$post->id) }}"class="btn btn-danger waves-effect">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="POST" style="display: none;">
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
    function deletePost(id) {
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