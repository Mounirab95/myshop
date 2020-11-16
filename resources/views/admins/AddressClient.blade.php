<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | info client</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles --> 
<link rel="stylesheet" href="{{asset('frontend')}}/css/userstyle.css" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/v4-shims.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/slicknav.min.css" type="text/css"> 
<script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 m-2 p-2 text-white text-uppercase d-none d-lg-inline-block" href="{{url('/')}}" > <i class="fas fa-home"> </i> Acceuil</a>
        &nbsp;&nbsp;
        <a class="h4 m-2 p-2 text-white text-uppercase d-none d-lg-inline-block" href="{{route('shop')}}" ><i class="fas fa-store"> </i> Boutique</a>
        &nbsp;&nbsp;
        <a class="h4 m-2 p-2 text-white text-uppercase d-none d-lg-inline-block" href="{{url('/')}}" ><i class="far fa-question-circle"> </i> Apropos</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            
          </div>
        </form>
        <!-- User -->
        <div class="header__top__right__auth">
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
                  @guest
                      <div class="row">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                      </li>&nbsp;&nbsp;&nbsp;
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('inscription') }}</a>
                          </li>
                      </div>
                      @endif
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                  {{ __('Déconnecter') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest
            </ul>
          </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 200px; background-image: url(https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Bonjour {{ Auth::user()->name }}</h1>
            <p class="text-white mt-0 mb-5">Vous Trouvez les infos de vous client</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Des information de client </h3>
                </div>
                
              </div>
            </div>
            <div class="card-body"> 
            @foreach( $idUserInfo as $information)
               <div>
                    <h6 class="heading-small text-muted mb-4">Formulaire d'information
                    </h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-first-name">Nom: {{$information->name}}</label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-last-name">Prénom: {{$information->familyname}}</label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Tél: {{$information->telephone}}</label>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Mon Adresse: {{$information->address}}</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-city">Ville: {{$information->city}}</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group focused">
                            <label class="form-control-label" for="input-country">Pays: {{$information->country}}</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label" for="input-country">Code postale: {{$information->postale}}</label>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
           @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<footer class="footer">
    <div class="col-xl-6 m-auto text-center">
          <p>Made with <a >Argon Dashboard</a> MB</p>
    </div>
  </footer>