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
							<form action="{{route('updateproduct',$ProductId->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
								<div class="form-group">
									<label>Titre de produit</label>
									<input name="title" type="text" class="form-control input-full" id="inlineinput" value="{{$ProductId->title}}" >
								</div>
								<div class="form-group">
									<label>Prix de Produit</label>
									<input name="price" type="number" class="form-control input-full" id="inlineinput" value="{{$ProductId->price}}">
								</div>
								<br>
								<div class="form-group">
									<label>Reduction %</label>
									<input name="reduction" type="number" class="form-control input-full" id="inlineinput" value="{{$ProductId->reduction}}" >
									<p><span class="label label-info">Attention </span> Si le produit n'est pas en promotion il faut mettre 0 dans reduction</p>
								</div>
								<br>

								<br>
								<div class="form-group">
									<label>Text area</label>
									<textarea name="description"  class="form-control" id="summary-ckeditor" rows="20" >{{$ProductId->description}}
									</textarea>
								</div>
								<div class="card-action">
										<button type="submit" class="btn btn-success">mise A jour</button>
										<a href="{{url('admin')}}" class="btn btn-danger">Annuler</a>
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



