@extends('layouts.app')
@section('styles')
<style>
	
	textarea {

		resize: none ; 
	}
	.card-skitch{

		border-radius: 0px;
		background : #555;
	}

	.card-skitch .card-header{

		background : #DDD;

	}
</style>
@endsection
@section('content')
	
	@foreach($skitches as $skitch)

	<div class="card m-4 p-4 card-skitch">
		<div class="card-header">
			<h2><a href="{{route('skitch.show',['user' => $skitch->author->username, 'skitch' => $skitch->id])}}">{{$skitch->title}} </a></h2>
			 <img src="{{$skitch->author->avatar}}" alt="" width="64" height="64"> <strong>{{$skitch->author->name}}</strong>
			<span class="pull-right"><span class="fa fa-eye"></span> {{$skitch->views}}</span>
		</div>
		<div class="card-body">
			<p>{{$skitch->description}}</p>
			<div class="form-group">
				<textarea  cols="30" rows="10" class="form-control">{{$skitch->code}}</textarea>
			</div>
		</div>

	</div>

	@endforeach
@endsection


@section('scripts')
<script>
	@if(session('flash'))
		alertify.success("{{session('flash')}}") ; 
	@endif	
</script>
@endsection
