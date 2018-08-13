<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Bootstrap sandbox</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/codemirror.css" />
	<style>
		.pagination li {
			padding : 6px;
			border: 1px solid blue;
			background : #E7FFFF;
		}

		li.active { 
			background : white;
			color : black ;
		 }

	</style>
</head>
<body>

<div class="container">
	<div class="page-header">
		<h1>{{$user->name}}</h1>
		<h5>@ {{$user->username}}</h5>
	</div>
	<div class="card">
		<div class="card-body">
			Country : {{$user->profile->country}}
			City : {{$user->profile->city}}

		</div>
	</div>
	<h1>My Threads</h1>
	<hr>
	@foreach($threads as $thread)
		<div class="card">
			<div class="card-header">
				<h4>{{$thread->title}}</h4>
			</div>
			<div class="card-body">
				<p>{{str_limit($thread->body,500)}}</p>
			</div>
		</div>

	@endforeach

	{{$threads->links()}}
	<h1>My Posts</h1>
	@foreach($posts as $post)
		<div class="card">
			<div class="card-header">
				<h4>{{$post->title}}</h4>
			</div>
			<div class="card-body">
				<img src="{{$post->cover}}" alt="">
				<p>{{str_limit($post->content,500)}}</p>
			</div>
		</div>
	
	@endforeach
	{{$posts->links()}}

	<h1>My Skitches</h1>
	@foreach($skitches as $skitch)
		<div class="card">
			<div class="card-header">
				<h4>{{$skitch->title}}</h4>
			</div>
			<div class="card-body">
				<textarea  class="editor"  cols="30" rows="10">{{$skitch->code}}</textarea>
			</div>
		</div>

	@endforeach

	{{$skitches->links()}}

	<h1>My Workspaces</h1>
	@foreach($workspaces as $workspace)
	<div class="card">
		<div class="card-header">
			<h4>{{$workspace->title}}</h4>
		</div>
		<div class="card-body">
			<p>{{$workspace->description}}</p>
		</div>
	</div>

	@endforeach

	{{$workspaces->links()}}

	
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="/js/libs/codemirror.js"></script>
<script>
	 CodeMirror.fromTextArea(document.querySelector('.editor'),{
		lineNumbers : true

	});
</script>
</body>
</html>