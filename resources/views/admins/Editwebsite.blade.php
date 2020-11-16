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
                        @forelse($AllEditWebsite as $info)
                        <div class="col-md-6">
                                <div class="form-group">
                                        <label>Proposition de laivrison: <br> 
                                        <div class="badge badge-danger">{{$info->proposition}}</div>
                                    </label>
                                    </div>
                                
                                <div class="form-group">
                                        <label>Les Reseaux social</label> <br>
                                        <label class="badge badge-default">facebook: {{$info->facebook}}</label>
                                        <br>
                                        <label class="badge badge-default">Instagram: {{$info->instagram}}</label>
                                        <br>
                                        <label class="badge badge-default">Youtube: {{$info->youtube}}</label>
                                        <br>
                                        <label class="badge badge-default">Twitter: {{$info->twitter}}</label>  
                                    </div>
                            </div>
                                <div class="col-md-6">

                                            <div class="form-group">
                                                    <label>Nos Contact</label> <br>
                                                    <label class="badge badge-default">Télè: {{$info->phone}}</label>
                                                    <br>
                                                    <label class="badge badge-default">Email: {{$info->Email}}</label>
                                                    <br>
                                                    <label class="badge badge-default">Adresse: {{$info->address}}</label>
                                                    <br>
                                                </div>

                                </div> 
                                <div class="col-md-12">
                                <hr>
                                        <div class="form-group">
                                        <label for="">Bref information:  <br> <br>{{$info->brefinfo}}</label>
                                        </div>
                                </div>

                                <div class="col-md-12">
                                <hr>
                                        <div class="form-group">
                                        <label for="">LA page de Apropos: <br>{!!html_entity_decode($info->about)!!}</label>
                                        </div>
                                </div>
                                <hr>

                                <div class="col-md-12">
                                <a href="{{route('edit',$info->id)}}"  class="btn btn-success">Editer les information</a>
                                </div>

                        @empty
                         <form action="{{route('StoreEditWebsite')}}" method="POST">
                             @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label>Proposition de laivrison</label>
                                        <input name="proposition" type="text" required class="form-control input-full" id="inlineinput" placeholder="Livraison gratuit">
                                    </div>
                                
                                <div class="form-group">
                                        <label>Les Reseaux social</label>
                                        <input name="facebook" type="link" required class="form-control input-full" id="inlineinput" placeholder="lien de facebook">
                                        <br>
                                        <input name="instagram" type="link" required class="form-control input-full" id="inlineinput" placeholder="lien de instagram">
                                        <br>
                                        <input name="twitter" type="link" required class="form-control input-full" id="inlineinput" placeholder="lien de twitter">
                                        <br>
                                        <input name="youtube" type="link" required class="form-control input-full" id="inlineinput" placeholder="lien de youtube">
                                    
                                    </div>
                            </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nos Contact</label>
                                                <input name="email" type="email" required class="form-control input-full" id="inlineinput" placeholder="Email">
                                                <br>
                                                <input name="phone" type="number" required class="form-control input-full" id="inlineinput" placeholder="Phone">
                                                <br>
                                                <input name="address" type="text" required class="form-control input-full" id="inlineinput" placeholder="Adresse">                                    
                                            </div>
                                    </div> 
                                   <div class="col-md-12">
                                    <div class="form-group">
                                            <label for="">Bref information</label>
                                            <textarea name="bref" required class="form-control input-full" id="inlineinput" cols="30" rows="10"></textarea>
                                        </div> 
                                   </div>
                                   <div class="col-md-12">
                                    <div class="form-group">
                                            <label for="">La page Apropos</label>
                                            <textarea name="description" required class="form-control" id="summary-ckeditor" rows="20" >
									</textarea>
                                        </div> 
                                   </div>
                                   <div class="col-md-12">
                                   <button type="submit" class="btn btn-success">Enregistré</button>
                                   <a  href="{{url('/admin')}}" class="btn btn-danger">Annuler</a>
                                   </div>
                            </form>
                        @endforelse
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




