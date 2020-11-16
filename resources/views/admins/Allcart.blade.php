@include('layouts.adminheader')

	<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Les Produits a jouter</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tout les Produits </h1>
			</div>
		</div><!--/.row-->
				
					
		<div class="panel panel-default">
					<div class="panel-body row">
						<div class="col-md-12">        
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nom De Produits</th>
                                    <th>Client</th>
                                    <th>Photo de Produit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(clientCart() as $allcart)
                                <tr>
                                    <td><i class="fas fa-cart-plus"> </i>{{$allcart->title}}</td>
                                    <td><i class="fas fa-user"> </i>{{$allcart->name}}</td>
                                    <td><img style="width: 75px;height: 60px;" src="{{asset('storage/'.$allcart->url)}}" alt=""></td>
                                </tr>
                                @empty
                                <p>Il ya pas de produit</p>
                                @endforelse
                                </tbody>
                            </table>
                            {{clientCart()->links()}}
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')




