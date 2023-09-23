<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Registrasi &mdash; SMKN TANJUNG SARI</title>

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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="{{asset('img/logo.png')}}" alt="logo" width="150" class="">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Registrasi Alumni SMKN TANJUNG SARI</h4></div>

              <div class="card-body">
                <form method="POST" action="{{route('register.post')}}">
                    @csrf
                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="frist_name">Nama Lengkap</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
                      @error('name')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="last_name">Email</label>
                      <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                      @error('email')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">NISN</label>
                    <input type="number" name="nisn" id="nisn" class="form-control @error('nisn') is-invalid @enderror">
                      @error('nisn')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                      @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-lg-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                      @error('password')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                      @error('password_confirmation')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Daftar
                    </button>
                  </div>
                </form>
              </div>
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
