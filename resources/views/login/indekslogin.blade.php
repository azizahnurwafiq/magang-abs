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
          <input type="text" name="username" class="form-control" value="{{ @old('username')}}" placeholder="Username">
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
          <input type="password" name="password" class="form-control"  placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>              
              Masuk
            </button>
          </div>
        </div>
      </form>
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
      swal({
        title: 'Berhasil',
        icon: 'success',
        text: '{{$message}}',
        showConfirmButton: true,
        timer: 1500
      });
    </script>
@endif

@if ($message = Session::get('failed'))
    <script>
      swal({
        title: 'Gagal',
        icon: 'error',
        text: '{{$message}}',
        showConfirmButton: true,
        timer: 1500
      });
    </script>
@endif
</body>
</html>
