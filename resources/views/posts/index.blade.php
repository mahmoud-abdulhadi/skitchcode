<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Bootstrap sandbox</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		.post{

			border-radius: 0px;
			margin-bottom: 20px;
			box-shadow: 3px 5px 10px #AAA;
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
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			@include('posts.categories')
		</div>
		<div class="col-md-6">
			@foreach($posts as $post)
				<div class="card post">
					<div class="card-header post-header">
						<h2><a href="{{$post->path()}}">{{$post->title}}</a></h2>
					</div>
					<div class="card-body post-body">
						<p>{{$post->content}}</p>
					</div>
				</div>

			@endforeach

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
	
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>