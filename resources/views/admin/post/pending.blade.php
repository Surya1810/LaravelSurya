@extends('layouts.backend.app')

@section('title','Post')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Post Pending</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.tag.index') }}">Post</a></li>
            <li class="breadcrumb-item active">Post Pending</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pending's {{ $posts->count() }}</h3>
            </div>
                <div class="card-body">
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>visibility</th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    {{--<th>Updated At</th>--}}
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
                                                    <span class="badge bg-blue">Published</span>
                                                @else
                                                    <span class="badge bg-yellow">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            {{--<td>{{ $post->updated_at }}</td>--}}
                    @role('super admin')
                                            <td class="text-center">
                                                @if($post->is_approved == false)
                                                    <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                                        <i class="fas fa-thumbs-up"></i>
                                                    </button>
                                                    <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form-{{ $post->id }}" style="display: none">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                @endif
                                                <a href="{{ route('admin.post.show',$post->id) }}" class="btn btn-info waves-effect">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.post.edit',$post->id) }}" class="btn btn-warning waves-effect">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $post->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
    
    function approvePost(id) {
        swal({
            title: 'Are you sure ?',
            text: "You went to approve this post!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Approve',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form-'+ id).submit();
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