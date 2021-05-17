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
                <h1>message</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Message</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Message's {{ $messages->count() }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <th width="15%">Name</th>
                                <th width="15%">Emails</th>
                                <th width="15%">Subject</th>
                                <th width="30%">Message</th>
                                <th width="15%">Time</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $key=>$Message)
                            <tr>
                                <td>{{ $Message->name }}</td>
                                <td>{{ $Message->email}}</td>
                                <td>{{ $Message->subject }}</td>
                                <td>{{ $Message->message }}</td>
                                <td>{{ $Message->created_at->diffForHumans() }}</td>

                                @can ('Content.tags')
                                <td class="text-center">
                                    <a href="{{ route('admin.message.reply',$Message->id) }}" class="btn btn-success waves-effect">
                                        <i class="fa fa-reply"></i>
                                    </a>

                                    <button class="btn btn-danger waves-effect" type="button" onclick="deleteMessage({{ $Message->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $Message->id }}" action="{{ route('admin.message.destroy',$Message->id) }}" method="POST" style="display: none;">
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
    function deleteMessage(id) {
        swal({
            title: 'Are you sure ?'
            , text: "Once deleted, you will not be able to recover this Message !"
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

