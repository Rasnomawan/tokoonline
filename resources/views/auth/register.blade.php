<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KyuraShop</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ 'lte/plugins/fontawesome-free/css/all.min.css' }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ 'lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css' }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ 'lte/dist/css/adminlte.min.css' }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Kyura</b>Shop</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new user</p>

      <form action="{{route('register')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
            @error('name')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
           @error('email')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           @error('password')
              <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" autocomplete="new-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{route('login')}}" class="text-center">I already have</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ 'lte/plugins/jquery/jquery.min.js' }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ 'lte/plugins/bootstrap/js/bootstrap.bundle.min.js' }}"></script>
<!-- AdminLTE App -->
<script src="{{ 'lte/dist/js/adminlte.min.js' }}"></script>
</body>
</html>
