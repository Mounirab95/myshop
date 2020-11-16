<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TactilePos|Site Officiel</title>
	<link rel = "icon" href = "{{asset('frontend')}}/img/logo.png" type = "image/x-icon"> 

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles --> 
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css" type="text/css">
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{url('/')}}"><h2>TactilePos</h2></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
            @if(Auth::check())
                <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>{{count(wishlistcount())}}</span></a></li>
                <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>{{count(cartcount())}}</span></a></li>
                @else
                <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>0</span></a></li>
                <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                @endif
            </ul>
            <div class="header__cart__price">Total Produit: <span>€{{totalPriceCart()}}</span></div>
        </div>
        <div class="humberger__menu__widget">
                <div class="header__top__right__auth">
                    <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <div class="row">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>&nbsp;&nbsp;
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
                                             @can("admins.admin",true)
                                                <a href="{{url('admin')}}" class="dropdown-item"><i class="fa fa-dashboard"></i>Administrateur</a>
                                            @endcan    
                                                <a href="{{url('home')}}" class="dropdown-item"><i class="fa fa-user"> </i> Mon Profil</a>
                                                <a href="{{route('favorite')}}" class="dropdown-item"><i class="fa fa-heart"> </i> Liste Favorable</a>
                                                <a href="{{route('cart')}}" class="dropdown-item"><i class="fa fa-shopping-bag"> </i> Ma Charette</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"><i class="fa fa-unlock"></i>
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
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="{{url('/')}}">Acceuil</a></li>
                <li><a href="{{route('shop')}}">Boutique</a></li>
                <li><a href="{{route('about')}}">A Propos</a></li>
                <li><a href="{{route('contact')}}">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-youtube"></i></a>

        </div>
        <div class="humberger__menu__contact">
            <ul>
                @forelse(infowebsite() as $info)
                <li><i class="fa fa-envelope"></i> {{$info->Email}}</li>
                <li>{{$info->proposition}}</li>
                @empty
                <li><i class="fa fa-envelope"></i> vide</li>
                <li>vide</li>
                @endforelse
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                            @forelse(infowebsite() as $info)
                            <li><i class="fa fa-envelope"></i> {{$info->Email}}</li>
                            <li>{{$info->proposition}}</li>
                            @empty
                            <li><i class="fa fa-envelope"></i> vide</li>
                            <li>vide</li>
                            @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                        @forelse(infowebsite() as $info)
                                <div class="header__top__right__social">
                                 <a href="{{$info->facebook}}"><i class="fa fa-facebook"></i></a>
                                 <a href="{{$info->instagram}}"><i class="fa fa-instagram"></i></a>
                                 <a href="{{$info->twitter}}"><i class="fa fa-twitter"></i></a>
                                 <a href="{{$info->youtube}}"><i class="fa fa-youtube"></i></a>
                                </div>
                                @empty
                                <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-instagram"></i></a>
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-youtube"></i></a>
                            </div>
                            @endforelse
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
                                            @can("admins.admin",true)
                                                <a href="{{url('admin')}}" class="dropdown-item"><i class="fa fa-dashboard"></i>Administrateur</a>
                                            @endcan 
                                                <a href="{{url('home')}}" class="dropdown-item"><i class="fa fa-user"> </i> Mon Profil</a>
                                                <a href="{{route('favorite')}}" class="dropdown-item"><i class="fa fa-heart"> </i> Liste Favorable</a>
                                                <a href="{{route('cart')}}" class="dropdown-item"><i class="fa fa-shopping-bag"> </i> Ma Charette</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"><i class="fa fa-unlock"></i>
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
                </div>
            </div>
        </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{url('/')}}"><h3>TactilePos</h3></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{url('/')}}">Acceuil</a></li>
                            <li><a href="{{route('shop')}}">Boutique</a></li>
                            <li><a href="{{route('about')}}">A Propos</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>@if(Auth::check())
                            <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>{{count(wishlistcount())}}</span></a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>{{count(cartcount())}}</span></a></li>
                            @else
                            <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                            @endif
                        </ul>
                        <div class="header__cart__price">Total Produit: <span>€{{totalPriceCart()}}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Catégories</span>
                        </div>
                        <ul>
							@foreach(myCategory() as $category)
                            <li><a href="{{url('filterCategory',$category->id)}}">{{$category->categorie}}</a></li>
							@endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="/search" method="POST" role="search">
                            @csrf
                                <input type="text" placeholder="Qui ce que vous cherchez?" class="form-control" name="q">
                                <button type="submit" class="site-btn">Chercher</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                            @forelse(infowebsite() as $info)
                                <h5>{{$info->phone}}</h5>
                            @empty
                            <h5>vide</h5>
                            @endforelse   
                                <span>support 24/7</span>
                            </div>
                        </div>
                    </div>
              