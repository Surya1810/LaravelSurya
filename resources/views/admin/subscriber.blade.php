@extends('layouts.backend.app')

@section('title','Subscribers')

@section('content')
@include('sweetalert::alert')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Subscriber</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Subscriber</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Subscriber's {{ $subscribers->count() }}</h3>
        </div>
        <!-- /.card-header -->
                <div class="card-body">
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    @can ('Subscriber')
                                    <th>Action</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscribers as $key=>$subscriber)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subscriber->email }}</td>
                                            <td>{{ $subscriber->created_at }}</td>
                                            <td>{{ $subscriber->updated_at }}</td>
                                            @can ('Subscriber')
                                            <td class="text-center">
                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteSubscriber({{ $subscriber->id }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $subscriber->id }}" action="{{ route('admin.subscriber.destroy',$subscriber->id) }}" method="POST" style="display: none;">
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
        function deleteSubscriber(id) {
        swal({
            title: 'Are you sure ?',
            text: "Once deleted, you will not be able to recover this subscriber !",
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