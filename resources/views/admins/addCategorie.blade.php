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
				<h1 class="page-header">Ajouter Ou supprimé une Categorie </h1>
			</div>
		</div><!--/.row-->
		@if(Session::has('successProduct'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('successProduct') }}</p>
        @endif
				
		
		<div class="panel panel-default">
					<div class="panel-heading">Les Categories</div>
					<div class="panel-body row">
						<div class="col-md-6">
							<form action="{{route('addCategorie')}}" method="POST">
								@csrf
                                <div class="form-group">
                                        <label>Ajouter Une categorie</label>
                                        <input name="newCategorie" type="text" class="form-control input-full" id="inlineinput" placeholder="Une categorie">
                                    </div>
                                <button type="submit" class="btn btn-primary">Ajouter une categorie</button>
                            </form>
                        </div>
                            <form action="{{route('DeleteCategorie')}}" method="POST">     
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                                <label>Supprimer une Categorie</label>
                                                    <select name="categorie" class="form-control">
                                                            <option>----------Selectionner une Categorie----------</option>
                                                                @foreach(myCategory() as $item)
                                                                <option value="{{$item->id}}">{{$item->categorie}}</option>
                                                                @endforeach
                                                    </select>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                            <br><br>
                                    <p>* Attention si vous supprimer une categorie vous risquer de supprimer le produit qui est relier avec et les charrette des clients et les favories</p>
								</div>
							</form>
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')




