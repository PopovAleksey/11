<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Constructor Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="login-page" style="min-height: 466px;">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="/" class="h1"><b>Sign</b>In</a>
        </div>
        <div class="card-body">
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="{{ $googleAuthLink }}" target="_blank" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="{{ $googleAuthLink }}" target="_blank" class="disabled btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="{{ $googleAuthLink }}" target="_blank" class="disabled btn btn-block btn-info">
                    <i class="fab fa-twitter mr-2"></i> Sign in using Twitter
                </a>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="{{ $googleAuthLink }}" target="_blank" class="disabled btn btn-block btn-warning">
                    <i class="fab fa-instagram mr-2"></i> Sign in using Instagram
                </a>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3" disabled>
                <a href="{{ $googleAuthLink }}" target="_blank" class="disabled btn btn-block btn-dark">
                    <i class="fab fa-github mr-2"></i> Sign in using GitHub
                </a>
            </div>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>


</body>
</html>