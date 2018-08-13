@extends('layouts.app')

@section('styles')

	<style>
		.thread{

			border-radius: 0px;
			margin-bottom: 20px;
			box-shadow: 3px 5px 10px #AAA;
		}

		.thread-header{

			background: #222;
			color : white;

			border-radius: 0px;
		}


		.thread-body{

			background : #BBB;
			color : #222;

		}
	</style>

@endsection


@section('content')
	<div class="row">
		<div class="col-md-3">
			@include('threads.channels')
		</div>
		<div class="col-md-6">
			@foreach($threads as $thread)
				<div class="card thread">
					<div class="card-header thread-header">
						<h2><a href="{{$thread->path()}}">{{$thread->title}}</a></h2>
						Published {{$thread->created_at->diffForHumans()}} by <a href="/threads?by={{$thread->author->username}}">{{$thread->author->name}}</a>
					</div>
					<div class="card-body thread-body">
						<p>{!! Markdown::convertToHtml($thread->body) !!}</p>
					</div>
				</div>

			@endforeach
		</div>
		<div class="col-md-3">
			@if(count($trends))
			<div class="card">
				<div class="card-header">
					<h3>Trending Discussions</h3>
				</div>

				<div class="card-body">
						<ul class="list-group">
						@foreach($trends as $thread)

							<li class="list-group-item"><a href="{{$thread->path}}">{{$thread->title}}</a></li>
						@endforeach				
						</ul>	
				</div>
			</div>
			@endif
		</div>
	</div>
	
</div>



@endsection