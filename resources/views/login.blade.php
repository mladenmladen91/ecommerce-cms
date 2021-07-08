<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="author" content="">

    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}"/>

    <!-- Custom fonts for this template-->
    <link href="vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="vendor/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="/css/login.css" rel="stylesheet">

    {{-- Includable CSS --}}
    {{--    @yield('styles')--}}
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper" style="height: 100vh">



        <!-- Main Content -->
        <div id="loginPage" class="container d-flex align-items-center justify-content-center flex-column">

            <div class="text-center">
            {{ Form::open(array('url' => 'login')) }}
            <div class="logoContainer text-center"><img width="300" src="/logo.png" alt="logo"></div>
            <div class="inputWrapper  m-2 ">
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
            </div>
            <div class="inputWrapper  m-2 ">
{{--                <input placeholder="" type="text" value=""><label>Korisničko ime</label>--}}
{{--                {{ Form::label('email', 'Korisničko ime') }}--}}
                {{ Form::text('email', Request::old('email'), array('placeholder' => 'Korisničko ime', 'class' => 'form-control')) }}
            </div>
            <div class="inputWrapper  m-2">
{{--                <input placeholder="" type="password" value=""><label>Lozinka</label>--}}
{{--                {{ Form::label('password', 'Password') }}--}}
                {{ Form::password('password', array('placeholder' => 'Lozinka', 'class' => 'form-control')) }}
            </div>
            <div class="buttonContainer text-center">
                {{ Form::submit(' Uloguj se ', array('class="btn btn-info"')) }}
{{--                <button class="mt-20 mx-auto btn btn-primary f-s-16 text-color-white transition-1 px-20 py-5 br-r-5"--}}
{{--                        type="">Uloguj se--}}
{{--                </button>--}}
            </div>
            <div class="copyright text-center m-2"><span
                    class="text-color-font-l"><i>Powered by</i> <b>FlexCMS</b></span></div>
            <!-- if there are login errors, show them here -->
{{--            <p>--}}
{{--                {{ $errors->first('email') }}--}}
{{--                {{ $errors->first('password') }}--}}
{{--            </p>--}}

{{--            <p>--}}
{{--                {{ Form::label('email', 'Email Address') }}--}}
{{--                {{ Form::text('email', Request::old('email'), array('placeholder' => 'awesome@awesome.com')) }}--}}
{{--            </p>--}}

{{--            <p>--}}
{{--                {{ Form::label('password', 'Password') }}--}}
{{--                {{ Form::password('password') }}--}}
{{--            </p>--}}

{{--            <p>{{ Form::submit('Submit!') }}</p>--}}
            {{ Form::close() }}
            </div>
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery.easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="vendor/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/dist/Chart.min.js"></script>

<script src="vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>

{{-- Includable JS --}}
@yield('scripts')
</body>

</html>
