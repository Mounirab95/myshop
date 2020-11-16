@include('layouts.adminheader')

	<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Tout les administrateurs</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tout les administrateurs</h1>
			</div>
		</div><!--/.row-->
				
					
		<div class="panel panel-default">
                    <div class="panel-heading">Mes Clients</div>
                    @if(Session::has('updateToUser'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('updateToUser') }}</p>
                    @endif
					<div class="panel-body row">
						<div class="col-md-12">        
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nom du client </th>
                                    <th>Email</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allAdmins as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <div class="row">
                                            <form action="{{route('updateAdmin')}}" method="POST"> 
                                                @csrf
                                                <input type="hidden" value="{{$user->id}}" name="admin_id">
                                                <button class="btn btn-warning m-2"><i class="fas fa-user-cog"> </i> Desctiver le role</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <p>Il ya pas de client</p>
                                @endforelse
                                </tbody>
                            </table>
                            {{$allAdmins->links()}}
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')




