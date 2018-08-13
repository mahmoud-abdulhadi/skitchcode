
@extends('layouts.app')


@section('styles')
		<style>
			

			.fa-users {

				color : #28A745;
			}

			.user-name {

				font-style: italic; 

				font-weight: 700;

				color : #565656;
			}
		</style>

@endsection

@section('content')

	<div class="card card-default">
		<div class="card-header">
			<h3>User Management <small><span class="fa fa-users"></span></small></h3>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
					<th>
						Image
					</th>
					<th>
						Name
					</th>
					<th>
						Permissions
					</th>
					<th>
						Delete
					</th>
				</thead>

				<tbody>
					@if($users->count() > 0 )
						@foreach($users as $user)
							<tr>
								<td>
								<img src="{{$user->avatar}}" 
										alt="{{$user->name}}" 
									width="60px"
									height="60px"
									style="border-radius: 50%;">
								</td>
								<td>
									<p class="user-name">{{$user->name}}</p>
								</td>
								<td>
									@if($user->admin)
										<a href="{{ route('user.not.admin',['user'=>$user->username]) }}" 
										   class=" btn btn-xs btn-danger"><span class="fa fa-handshake-o"></span> Remove permessions</a>
									@else
										<a href="{{ route('user.admin',['user'=>$user->username]) }}" 
										   class=" btn btn-xs btn-success"><span class="fa fa-handshake-o"></span> Make admin</a>
									@endif
								</td>
								<td>
										@if( Auth::id() !== $user->id)
										<a href="{{ route('user.delete',['user'=>$user->username]) }}" 
										   class=" btn btn-xs btn-danger"><span class="fa fa-trash"></span> Delete</a>
										@endif

								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<th colspan="5" class="text-center">No users</th>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	
@stop