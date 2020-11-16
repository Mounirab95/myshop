@extends('layouts.app')

@section('content')

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Connexion</h5>
            <form method="POST" action="{{ route('login') }}">
                        @csrf
              <div class="form-label-group">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="inputEmail">Email address</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-label-group">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="inputPassword">Password</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="custom-control custom-checkbox mb-3 container">
                    <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
                        {{ __('Connexion') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Oublier Mot de passe?') }}
                        </a>
                    @endif
              </div>
              <hr class="my-4">
                        
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
@endsection
