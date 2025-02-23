@extends('backoffice.layouts.auth')

@section('content')
<section class="d-flex justify-content-center align-items-center" style="margin-top: 16%">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 col-xl-4">
          <div class="card card-primary">

            <div class="card-body">
              <div class="text-center">
                <p class="fw-bold">Forgot Password</p>
                <p>Masukkan email anda yang telah di registraksikan di sistem!</p>
              </div>
              <form method="POST" action="{{ route('auth.reset.password') }}" class="needs-validation" novalidate>
                @csrf

                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" type="email" class="form-control" name="email" required autofocus>
                  <div class="invalid-feedback">Please fill in your email</div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="text-center mt-3 text-white">
            <small>Copyright &copy; Zakat 2025</small>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
