<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url(azizah.png); background-repeat:no-repeat;background-size:cover;">
<div class="login-box">
  <!-- <div class="login-logo">
    <a href="../../index2.html"><b>LOGIN</b></a>
  </div> -->
  <!-- /.login-logo -->
  <div class="card">
      <div class="card-body login-card-body">
        <h1 align="center">LOGIN</h1>
        <p class="login-box-msg">Insatsu Digital Printing</p>

      <form action="{{route('login.proses')}}" method="post">
        @csrf
        @error('username')
            <div class="form-text text-danger">{{$message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        @error('password')
            <div class="form-text text-danger">{{$message}}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        
        <div class="row">
          {{-- <div class="col-8">
            <div class="icheck-warning">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-12">
            <!-- <button type="submit" class="btn btn-primary btn-block">Log In</button> -->
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <p class="mb-1"> -->
        <!-- <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if ($message = Session::get('success'))
    <script>
      swal('{{$message}}');
    </script>
@endif

@if ($message = Session::get('failed'))
    <script>
      swal('{{$message}}');
    </script>
@endif
</body>
</html>
