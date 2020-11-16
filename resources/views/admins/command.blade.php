@include('layouts.adminheader')		
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
                                    <th>Nom de client</th>
                                    <th>Client</th>
                                    <th>quantity</th>
                                    <th>Paiment</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($ClientCommand as $Command)
                                <tr>
                                    <td><i class="fas fa-user"> </i> <a href="{{route('infoClient',$Command->user_id)}}" target="_bank">{{$Command->name}}</a> </td>
                                    <td><i class="fas fa-boxes"> </i>{{$Command->title}}</td>
                                    <td>{{$Command->quantity}}</td>
                                    <td><span class="label label-warning"><i class="fas fa-check-circle"></i> Succès</span></td>
                                    <td >
                                    @if(($Command->livraison==0)&&($Command->reception==0))
                                        <form action="{{route('delivery')}}" method="POST">
                                            @csrf
                                        <input type="hidden" name="id_command" value="{{$Command->id}}">
                                        <button class="btn btn-danger"><i class="fas fa-plane-departure"></i></button>
                                        </form>
                                        <br>
                                        <form action="{{route('reception')}}" method="POST">
                                            @csrf
                                        <input type="hidden" name="id_command" value="{{$Command->id}}">
                                        <button class="btn btn-danger"><i class="fas fa-plane-arrival"></i></button>
                                        </form>
                                                @elseif(($Command->livraison==1)&&($Command->reception==0))
                                                <form>
                                                <span  class="label label-success"><i class="fas fa-check"></i>Livrée</span>
                                                </form>
                                                <br>
                                                <form action="{{route('reception')}}" method="POST">
                                                  @csrf
                                                      <input type="hidden" name="id_command" value="{{$Command->id}}">
                                                      <button class="btn btn-danger"><i class="fas fa-plane-arrival"></i></button>
                                                </form>
                                                 @else 
                                                    <form>
                                                    <span  class="label label-success"><i class="fas fa-check"></i>recepetion Conf</sapn>
                                                    </form>
                                                    
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <p>Il ya pas de produit</p>
                                @endforelse
                                </tbody>
                            </table>
                            <p><i class="fas fa-radiation-alt"> </i> Pour avoir l'adresse de vous client cliquer sur leur nom</p>
                            <p><i class="fas fa-plane-departure"> </i> Une fois vous envoyez le produit cliquer sur ce button pour confirmer</p>
                            <p><i class="fas fa-plane-arrival"> </i> Une fois le client reçoi le produit cliquer sur ce button pour confirmer</p>
                            {{$ClientCommand->links()}}
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')