<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TactilePos - Admin</title>
	<link href="{{asset('frontendadmin')}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{asset('frontendadmin')}}/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{asset('frontendadmin')}}/css/datepicker3.css" rel="stylesheet">
	<link href="{{asset('frontendadmin')}}/css/styles.css" rel="stylesheet">
	<link rel = "icon" href = "{{asset('frontend')}}/img/logo.png" type = "image/x-icon"> 
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script defer src="https://use.fontawesome.com/releases/v5.15.1/js/all.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.15.1/js/v4-shims.js"></script>
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="{{url('/')}}"><span>Tactile Pos</span>Admin</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fas fa-boxes"></em><span class="label label-danger">{{count(countCommand())}}</span>
					</a>

					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="{{url('/')}}"><span>Tactile Pos</span>Admin</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="{{route('admin')}}"><em class="fa fa-dashboard">&nbsp;</em> Tableau de bord</a></li>
			<li><a href="{{route('Allcart')}}"><i class="fas fa-shopping-cart"> </i> Charettes clients </a></li>
			<li><a href="{{route('ClientCommand')}}"><i class="fas fa-boxes"> </i> Commandes clients</a></li>
			<li><a href="{{route('addProduct')}}"><i class="fas fa-plus-square"> </i> Ajouter Produit</a></li>
			<li><a href="{{route('MyProducts')}}"><i class="fas fa-box-open"> </i> Mes Produits</a></li>
			<li><a href="{{route('Categorie')}}"><i class="fas fa-calendar-alt"></i>Les Catégories</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1"> Les Utilisateurs <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="{{route('allusers')}}">
						<span class="fa fa-arrow-right">&nbsp;</span>Les clients
					</a></li>
					<li><a class="" href="{{route('alladmins')}}">
						<span class="fa fa-arrow-right">&nbsp;</span> Les administrateurs
					</a></li>
				</ul>
			</li>
			<li><a href="{{route('EditWebsite')}}"><i class="fas fa-pager"> </i> Editer le Site</a></li>
			<li><a class="dropdown-item" href="{{ route('logout') }}"
				onclick="event.preventDefault();
				document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
					{{ __('Déconnecter') }}</a></li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
		</ul>
	</div>