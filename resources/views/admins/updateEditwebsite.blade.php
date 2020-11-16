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
				<h1 class="page-header">Editer les information du site</h1>
			</div>
		</div><!--/.row-->
		@if(Session::has('EditWebsite'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('EditWebsite') }}</p>
        @endif
				
		
		<div class="panel panel-default">
					<div class="panel-heading">Les informations du site</div>
					<div class="panel-body row">                        
                         <form action="{{route('update',$idInfo->id)}}" method="POST">
                            @method('PATCH')
                             @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label>Proposition de laivrison</label>
                                        <input name="proposition" type="text" required class="form-control input-full" id="inlineinput" value="{{$idInfo->proposition}}">
                                    </div>
                                
                                <div class="form-group">
                                        <label>Les Reseaux social</label>
                                        <input name="facebook" type="link" required class="form-control input-full" id="inlineinput" value="{{$idInfo->facebook}}">
                                        <br>
                                        <input name="instagram" type="link" required class="form-control input-full" id="inlineinput" value="{{$idInfo->instagram}}">
                                        <br>
                                        <input name="twitter" type="link" required class="form-control input-full" id="inlineinput" value="{{$idInfo->twitter}}">
                                        <br>
                                        <input name="youtube" type="link" required class="form-control input-full" id="inlineinput" value="{{$idInfo->youtube}}">
                                    
                                    </div>
                            </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nos Contact</label>
                                                <input name="email" type="email" required class="form-control input-full" id="inlineinput" value="{{$idInfo->Email}}">
                                                <br>
                                                <input name="phone" type="number" required class="form-control input-full" id="inlineinput" value="{{$idInfo->phone}}">
                                                <br>
                                                <input name="address" type="text" required class="form-control input-full" id="inlineinput" value="{{$idInfo->address}}">                                    
                                            </div>
                                    </div> 
                                   <div class="col-md-12">
                                    <div class="form-group">
                                            <label for="">Bref information</label>
                                            <textarea name="bref" required class="form-control input-full" id="inlineinput" cols="30" rows="10">{{$idInfo->brefinfo}}</textarea>
                                        </div> 
                                   </div>
                                   <div class="col-md-12">
                                    <div class="form-group">
                                            <label for="">La page Apropos</label>
                                            <textarea name="description" required class="form-control" id="summary-ckeditor" rows="20">
                                            {{$idInfo->about}}
									        </textarea>
                                        </div> 
                                   </div>
                                   <div class="col-md-12">
                                   <button type="submit" class="btn btn-success">Enregistré</button>
                                   <a  href="{{url('/admin')}}" class="btn btn-danger">Annuler</a>
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




