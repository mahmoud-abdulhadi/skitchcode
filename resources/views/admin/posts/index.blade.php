@extends('layouts.app')


@section('styles')
	<style>
		.post{

			border-radius: 0px;
			margin-bottom: 20px;
			box-shadow: 3px 5px 10px #222;
		}

		.post-header{

			background: #222;
			color : white;

			border-radius: 0px;
		}


		.post-body{

			background : #BBB;
			color : #222;

		}

		.card { 
			width :100%;
		 }

		.card-img-top {

			/*width : 300px;
			height : 300px;*/
			border-radius: 0px;
			border:2px solid #222;

		}
	</style>

@endsection
@section('content')


	<div class="row">
		<div class="col-md-3">
			@include('posts.categories')
		</div>
		<div class="col-md-6">
			@foreach($posts as $post)
				<div class="card m-4 p-4 post" >
				<div class="row">
					<div class="col-sm-6">
  					<a href="{{$post->path()}}"><img class="card-img-top" src="{{$post->cover}}" alt="Card image cap"></a>
  					</div>
  				<div class="col-sm-6">
  				<h4 class="card-title mb-4"><a href="{{$post->path()}}">{{$post->title}}</a></h4>
  				<h6 class="card-subtitle mb-2 text-muted">Published {{$post->created_at->diffForHumans()}} By {{$post->author->name}}</h6>
  				<p class="card-text mt-5">{!!str_limit($post->content,550)!!}</p>
  				</div>
  				</div>
  				<div class="card-body">
    			
  			</div>
  			<div class="card-footer">
  				<a href="" class="btn btn-info mr-4">Edit</a>
  				<a href="" class="btn btn-danger">Delete</a>


  			</div>
		</div>

			@endforeach
		

			{{$posts->links()}}
		
		</div>
		<div class="col-md-3">
			@if(count($trends))
			<div class="card post">
				<div class="card-header">
					<h4>Trending Posts</h4>
				</div>
				<div class="card-body">
					<ul class="list-group">
						@foreach($trends as $post)

							<li class="list-group-item"><a href="#">{{$post->title}}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif

		</div>


	</div>
	


@endsection


@section('scripts')
	<script>
		var ul = document.querySelector('.pagination');

		ul.classList.add('justify-content-center');

		var items = document.querySelectorAll('.pagination li');

		for(var i = 0 ; i < items.length;i++){

			items[i].classList.add('page-item');
		}

		var links = document.querySelectorAll('.pagination a');
		for(var i = 0 ; i < links.length;i++){

			links[i].classList.add('page-link');
		}

		var spans = document.querySelectorAll('.pagination span'); 
		for(var i = 0 ; i < spans.length;i++){

			spans[i].classList.add('page-link');
		}

		if('{{Session::has("flash")}}'){

			alertify.success('{{Session::get("flash")}}')
		}
	</script>
@endsection