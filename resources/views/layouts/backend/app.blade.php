
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Author Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/backend/dist/css/adminlte.min.css') }}">
    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">

    @yield ('style')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    @include ('layouts.backend.partial.header')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include ('layouts.backend.partial.sidebar')
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- End Content Header (Page header) -->

<!-- Main content start -->
@yield('content')
<!-- End main content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0-rc
</div>
<strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/backend/dist/js/demo.js') }}"></script>
<!-- Page specific script -->
@yield('scripts')

<script>
$(function () {
//Enable check and uncheck all functionality
$('.checkbox-toggle').click(function () {
    var clicks = $(this).data('clicks')
    if (clicks) {
    //Uncheck all checkboxes
    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
    } else {
    //Check all checkboxes
    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
    }
    $(this).data('clicks', !clicks)
})

//Handle starring for font awesome
$('.mailbox-star').click(function (e) {
    e.preventDefault()
    //detect type
    var $this = $(this).find('a > i')
    var fa    = $this.hasClass('fa')

    //Switch states
    if (fa) {
    $this.toggleClass('fa-star')
    $this.toggleClass('fa-star-o')
    }
})
})
</script>
</body>
</html>
