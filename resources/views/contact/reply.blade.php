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
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Read Mail</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-read-info">
                    <h5>{{$message->subject}}</h5>
                    <h6>From: {{$message->email}}
                        <span class="mailbox-read-time float-right">{{$message->created_at}}</span></h6>

                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" onclick="deleteMessage({{ $message->id }})" data-container="body" title="Delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <form id="delete-form-{{ $message->id }}" action="{{ route('admin.message.destroy',$message->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm" title="Print">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                    {{$message->message}}
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-reply"></i> Reply</button>

                </div>
                <button type="button" class="btn btn-default" onclick="deleteMessage({{ $message->id }})"><i class="far fa-trash-alt"></i> Delete</button>
                <form id="delete-form-{{ $message->id }}" action="{{ route('admin.message.destroy',$message->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.reply.send') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" style="font-weight: bold" class="float-left">Name</label>
                                <input type="text" class="form-control" name="name" required value="{{ $message->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email" style="font-weight: bold" class="float-left">E-Mail</label>
                                <input type="email" class="form-control" name="email" required value="{{ $message->email }}">

                            </div>
                            <div class="form-group">
                                <label for="message" style="font-weight: bold" class="float-left">Message</label>
                                <textarea class="form-control" name="message" required rows="7"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


</section>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
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

