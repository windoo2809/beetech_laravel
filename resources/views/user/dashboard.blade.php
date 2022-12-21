<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard User</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset ('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset ('dist/css/adminlte.min.css')}}">
    
</head>

<style>
button {
    cursor: pointer;
}


.pdfobject-container {
    height: 30rem;
    border: 1rem solid rgba(0, 0, 0, 0.1);
}

.trigger {
    border: none;
    font-size: 0.875rem;
    font-weight: 300;
}

.trigger i {
    margin-right: 0.3125rem;
}

.trigger:hover {
    box-shadow: 0 0.875rem 1.75rem rgba(0, 0, 0, 0.25), 0 0.625rem 0.625rem rgba(0, 0, 0, 0.22);
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 0vh;
    background-color: transparent;
    overflow: hidden;
    transition: background-color 0.25s ease;
    z-index: 9999;
}

.modal.open {
    position: fixed;
    width: 100%;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.5);
    transition: background-color 0.25s;
}

.modal.open>.content-wrapper {
    transform: scale(1);
}

.modal .content-wrapper {
    position: relative;
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    justify-content: flex-start;
    width: 50%;
    margin: 0;
    padding: 2.5rem;
    background-color: white;

    transform: scale(0);
    transition: transform 0.25s;
    transition-delay: 0.15s;
}

.modal .content-wrapper .close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.5rem;
    height: 2.5rem;
    border: none;
    background-color: transparent;
    font-size: 1.5rem;
    transition: 0.25s linear;
}

.modal .content-wrapper .close:before,
.modal .content-wrapper .close:after {
    position: absolute;
    content: "";
    width: 1.25rem;
    height: 0.125rem;
    background-color: black;
}

.modal .content-wrapper .close:before {
    transform: rotate(-45deg);
}

.modal .content-wrapper .close:after {
    transform: rotate(45deg);
}

.modal .content-wrapper .close:hover {
    transform: rotate(360deg);
}

.modal .content-wrapper .close:hover:before,
.modal .content-wrapper .close:hover:after {
    background-color: tomato;
}

.modal .content-wrapper .modal-header h2 {
    font-size: 1.5rem;
    font-weight: bold;
}

/*  */
.modal .content-wrapper .content p {
    font-size: 0.875rem;
    line-height: 1.75;
}
</style>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @include('user.layout.header')
        <!-- Main Sidebar Container -->
        @include('user.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <!-- yield content -->
        <!-- Content Header (Page header) -->
        @yield('content')
        @include('sweetalert::alert')
        <!-- /.content-header -->

        <!-- Main content -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.control-sidebar -->
    @include('user.layout.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset ('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset ('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset ('dist/js/adminlte.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{asset ('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{asset ('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset ('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{asset ('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset ('plugins/chart.js/Chart.min.js')}}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{asset ('dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset ('dist/js/pages/dashboard2.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- proudct-category json_decode -->
     <!-- end proudct-category json_decode -->
</body>

</html>