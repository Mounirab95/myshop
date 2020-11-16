@include('layouts.adminheader')

	<!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Tout les clients</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tout les clients </h1>
			</div>
		</div><!--/.row-->
				
					
		<div class="panel panel-default">
                    <div class="panel-heading">Mes Clients</div>
                    @if(Session::has('updatemessage'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('updatemessage') }}</p>
                    @endif
                    @if(Session::has('updateToAdmin'))
                        <p class="alert {{ Session::get('alert-class', 'alert-warning') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('updateToAdmin') }}</p>
                    @endif
					<div class="panel-body row">
						<div class="col-md-12">        
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nom du client </th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allUsers as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <form action="{{route('updateUser')}}" method="POST"> 
                                            @csrf
                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                            <button class="btn btn-success m-2"><i class="fas fa-user-cog"> </i> Ajouter comme admin</button>
                                        </form>
                                    </td>
                                    <td>
                                         <form action="{{route('deleteUser')}}" method="POST">
                                             @csrf
                                            <input type="hidden" value="{{$user->id}}" name="user_id">
                                            <button class="btn btn-danger m-2"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <p>Il ya pas de client</p>
                                @endforelse
                                </tbody>
                            </table>
                            {{$allUsers->links()}}
					    </div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->


@include('layouts.adminfooter')




