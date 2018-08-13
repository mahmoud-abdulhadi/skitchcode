<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Bootstrap sandbox</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
     .card {
        .border-radius: 0px;
     }
    .card-header{

      background : #222;

      color : white;
      border-radius: 0px;
    }
    .card-body{

        background : #FFF;
    }

    .card {
      border : 1px solid #000;


    }

    .flex {

      display: flex; 
    }

    .btn{

      border-radius: 0px;
    }


  </style>
</head>
<body>

<div class="container p-5">
	<div class="card">
  <div class="card-header">
    
    <h1>{{$post->title}}</h1>
    @can('delete',$post)
    <form action="{{$post->path()}}" method ="POST">
      {{csrf_field()}}
      {{method_field('DELETE')}}
     <button class="btn btn-danger btn-sm pull-right">Delete Post</button>
      
    </form>
    @endcan

    @can('update',$post)
    
      <a  href="/posts/edit/{{$post->id}}" class="btn btn-info btn-sm pull-right mr-2">Edit Post</a>
    @endcan
    <small>Published {{$post->created_at->diffForHumans()}} By {{$post->author->name}}</small>
    
  </div>
  <div class="card-body">
    <p class="card-text">{!!$post->content!!}</p>
  
  </div>
</div>	
	
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>