@extends('layouts.app')


@section('content')
<div class="container mt-1">
	<div class="card">
		<div class="card-content">

	<div class="columns">
		
		<div class="column">
			<h1 class="title is-1">{{$thread->title}}</h1>
			@can('delete',$thread)
			<form action="{{$thread->path()}}" method="POST">
				{{csrf_field()}}
				{{method_field('DELETE')}}
				<button class="button is-danger">Delete Thread</button>
				
			</form>
			@endcan
			<p class="subtitle is-3">published {{$thread->created_at->diffForHumans()}} By {{$thread->author->name}}</p>
		</div>
	</div>
	<div class="columns">
		<div class="column is-9">
			<div class="box">
  				<p>{!! Markdown::convertToHtml($thread->body) !!}</p>
			</div>
		</div>
	</div>

	  @foreach($thread->comments as $comment)
    <div class="columns">
      <div class="column is-8">
        
        <div class="box">
  <article class="media">
    <div class="media-left">
      <figure class="image is-96x96">
        <img src="{{$comment->author->avatar}}" alt="Image">
      </figure>
    </div>
    <div class="media-content">
      <div class="content">
        <p>
          <strong>{{$comment->author->name}}</strong> <small>@ {{$comment->author->username}}</small> <small>{{$comment->created_at->diffForHumans()}}</small>
          <br>
          {{$comment->body}}
        </p>
      </div>
		      <nav class="level is-mobile">
		        <div class="level-left">
		          <a class="level-item" aria-label="reply">
		            <span class="icon is-small">
		              <i class="fas fa-reply" aria-hidden="true"></i>
		            </span>
		          </a>
		          <a class="level-item" aria-label="retweet">
		            <span class="icon is-small">
		              <i class="fas fa-retweet" aria-hidden="true"></i>
		            </span>
		          </a>
		          <a class="level-item" aria-label="like">
		            <span class="icon is-small">
		              <i class="fas fa-heart" aria-hidden="true"></i>
		            </span>
		          </a>
		        </div>
		      </nav>
		    </div>
		  </article>
		</div>
      </div>  
    

    </div>


  @endforeach
  </div>
  </div>
  </div>

@endsection