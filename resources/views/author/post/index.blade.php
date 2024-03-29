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
            <li class="breadcrumb-item"><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Post</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Your Post's {{ $posts->count() }}</h3>
        </div>
        <!-- /.card-header -->
                <div class="card-body">
                @can ('Content.create')
                <div style="padding-bottom: 20px">
                    <a class="btn btn-primary waves-effect" href="{{ route('author.post.create') }}">
                        <i class="fa fa-plus-square"></i>
                        <span>Add New Post</span>
                    </a>
                </div>
                @endcan
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    {{--<th>Updated At</th>--}}
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
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-yellow">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            {{--<td>{{ $post->updated_at }}</td>--}}
                                            <td class="text-center">
                                                <a href="{{ route('author.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @can ('Content.edit')
                                                <a href="{{ route('author.post.edit',$post->id) }}" class="btn btn-warning waves-effect">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                @endcan
                                                @can ('Content.delete')
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $post->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('author.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
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
    function deletePost(id) {
        swal({
            title: 'Are you sure ?',
            text: "this post will go to trash if deleted, you can check there!",
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