@extends('layouts.backend.app')

@section('title','Post')

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Post Trashed</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Trashed Post</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Post Trashed</h3>
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
                                    <th>View</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
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
                                            
                                            <td class="text-center">
                                                @can ('Content.restore')
                                                <a href="{{ route('admin.post.restore',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="fa fa-trash-restore"></i>
                                                </a>
                                                @endcan
                                                @can ('Content.kill')
                                                <button class="btn btn-danger waves-effect" type="button" onclick="killPost({{ $post->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.kill', $post->id) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                                @endcan
                                            </td>
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
    function killPost(id) {
        swal({
            title: 'Are you sure ?',
            text: "Once deleted, you will not be able to recover this post ! ini ?",
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