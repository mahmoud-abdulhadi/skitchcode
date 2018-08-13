@extends('layouts.app')


@section('content')
	
	@foreach($workspaces as $workspace)

	<div class="card m-5 p-4">
		<div class="card-header">
			<h2><a href="{{route('workspace.show',['user'=> $workspace->author->username, 'workspace' => $workspace->id])}}">{{$workspace->title}}</a> <small>{{$workspace->author->name}}</small></h2>
			<span class="pull-right"><span class="fa fa-eye"></span> {{$workspace->views}}</span>
		</div>
		<div class="card-body">
			<p>{{$workspace->description}}</p>
		</div>

	</div>

	@endforeach


@endsection

@section('scripts')
<script>
	@if(session('flash'))

		window.alertify.success("{{session('flash')}}"); 


	@endif
</script>
@endsection