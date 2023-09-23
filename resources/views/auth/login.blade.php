<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; SMKN TANJUNG SARI</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('') }}modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('') }}modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('') }}modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('') }}css/style.css">
  <link rel="stylesheet" href="{{asset('') }}css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{asset('img/logo.png') }}" alt="logo" width="150" class="">
            </div>
            @if (session()->has('message'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{session()->get('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card card-primary">
              <div class="card-header"><h4>SMKN TANJUNG SARI</h4></div>

              <div class="card-body">
                <form method="POST" action="{{route('login.post')}}" class="needs-validation" novalidate="">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email Or Nisn</label>
                    <input id="nisn" type="text" class="form-control" name="nisn" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Email Or Nisn Tidak Boleh Kosong
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Password Tidak Boleh Kosong
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Daftar Sebagai Alumni? <a href="{{route('register')}}">Daftar</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; SMKN TANJUNG SARI {{date('Y')}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('') }}modules/jquery.min.js"></script>
  <script src="{{asset('') }}modules/popper.js"></script>
  <script src="{{asset('') }}modules/tooltip.js"></script>
  <script src="{{asset('') }}modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('') }}modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('') }}modules/moment.min.js"></script>
  <script src="{{asset('') }}js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{asset('') }}js/scripts.js"></script>
  <script src="{{asset('') }}js/custom.js"></script>
</body>
</html>
