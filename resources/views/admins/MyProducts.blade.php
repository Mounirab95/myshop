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
                    <div class="panel-heading">Mes Produits</div>
                    @if(Session::has('updatemessage'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('updatemessage') }}</p>
                    @endif
                    @if(Session::has('productDeleted'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('productDeleted') }}</p>
                    @endif
					<div class="panel-body row">
						<div class="col-md-12">        
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Photo de Produit</th>
                                    <th>De Produits</th>
                                    <th colspan="3">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse(Myproduct() as $product)
                                <tr>
                                    <td><img style="width: 75px;height: 60px;" src="{{asset('storage/'.$product->url)}}" alt=""></td>
                                    <td>{{$product->title}}</td>
                                    <td>
                                        <div class="row">
                                        <form action="{{route('DeleteProducts')}}" method="POST"> 
                                        @csrf
                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                        <button class="btn btn-danger m-2"><i class="fas fa-trash-alt"></i></button>
                                        <a href="{{route('editProduct',$product->id)}}" class="btn btn-info m-2"><i class="far fa-edit"></i></a>
                                        <a target="_blank" class="btn btn-success m-2" href="{{url ('detail',$product->id)}}"><i class="far fa-eye"></i></a>
                                        </form>
                                      
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <p>Il ya pas de produit</p>
                                @endforelse
                                </tbody>
                            </table>
                            {{Myproduct()->links()}}
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')




