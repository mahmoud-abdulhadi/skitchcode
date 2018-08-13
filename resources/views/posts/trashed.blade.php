
@extends('layouts.app')

@section('content')

	<div class="card card-default">

		<div class="card-heading">
			<h4 style="color: darkred">Trashed posts</h4>
		</div>

		<div class="card-body">
			<table class="table table-haver">
				<thead>
					<th>
						Image
					</th>
					<th>
						Title
					</th>
					<th>
						Edit
					</th>
					<th>
						Restore
					</th>
					<th>
						Destroy
					</th>
				</thead>

				<tbody>
					@if($posts->count() > 0)
						@foreach($posts as $post)
							<tr>
								<td> <img src="{{$post->cover}}" alt="{{ $post->title }}"
								  width="90px" height="50px">
								</td>
						
								<td>{{ $post->title }}</td>
								<td>Edit</td>
								<td>
									<a href="{{route('post.restore',['id'=> $post->id])}}" 
									   class="btn btn-xs btn-success"> Restore
									</a>
								</td>
								<td>
									<a href="{{route('post.kill',['id'=> $post->id])}}" 
									   class="btn btn-xs btn-danger"> Delete
									</a>
								</td>
							</tr>
						@endforeach

					@else
						<tr>
							<th colspan="5" class="text-center">No Trashed posts</th>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	
@stop