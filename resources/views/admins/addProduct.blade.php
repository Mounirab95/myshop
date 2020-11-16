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
				<h1 class="page-header">Ajouter un nouveau Produit </h1>
			</div>
		</div><!--/.row-->
		@if(Session::has('successProduct'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('successProduct') }}</p>
        @endif
				
		
		<div class="row">
			<div class="col-lg-12"><!-- /.panel-->
				<div class="panel panel-default">
					<div class="panel-heading">Formulaire de produit </div>
					<div class="panel-body">
						<div class="col-md-12">
							<form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="form-group">
									<label >Choisissez Votre cathegorie</label>
									<select name="categorie" class="form-control" >
										<option>---Cathegories---</option>
										@foreach($categories as $item)
										<option value="{{$item->id}}">{{$item->categorie}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Titre de produit</label>
									<input name="title" required type="text" class="form-control input-full" id="inlineinput" placeholder="Titre" >
								</div>
								<div class="form-group">
									<label>Prix de Produit</label>
									<input name="price" required type="number" class="form-control input-full" id="inlineinput" placeholder="Prix">
								</div>
								<div class="form-group">
									<label class="custom-file-label" for="customFile">Choisir Une Photo miniature:</label>
									<input name="miniature" required type="file" class="custom-file-input" id="customFile">
								</div>
								<br>
								<div class="form-group">
									<label>Reduction %</label>
									<input name="reduction" type="number" min="0" required class="form-control input-full" id="inlineinput" placeholder="Reduction" >
									<p><span class="label label-info">Attention </span> Si le produit n'est pas en promotion il faut mettre 0 dans reduction</p>
								</div>
								<br>
								<div class="form-group">
									<label class="custom-file-label" for="customFile">Ajouter les Photos de gallery:</label>	
									<input name="photos[]" multiple required type="file" class="custom-file-input" id="customFile">
								</div>
								<br>
								<div class="form-group">
									<label >La livraison Dans:</label>
									<select name="livraison" class="form-control" >
										<option>---livraison---</option>
										<option value="">1 jour</option>
										<option value="5">5 jours</option>
										<option value="10">10 jours</option>
										<option value="15">15 jours</option>
										<option value="20">20 jours</option>
										<option value="25">25 jours</option>
										<option value="30">30 jours</option>
										<option value="35">35 jours</option>
										<option value="40">40 jours</option>
										<option value="45">45 jours</option>
										<option value="50">50 jours</option>
									</select>
								</div>
								<div class="form-group">
									<label>Text area</label>
									<textarea name="description" required class="form-control" id="summary-ckeditor" rows="20" >
									</textarea> 
								</div>
								<div class="card-action">
										<button type="submit" class="btn btn-success">Enregistré</button>
										<a href="{{route('admin')}}" class="btn btn-danger">Annuler</a>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>



