@extends('layouts.app')

@section('styles')

<style>

	.card{

		box-shadow: 7px 6px 13px #000;

		padding : 40px;
	}
</style>
@endsection
@section('content')
	<div class="container">
		@if(count($errors) > 0 )
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">
					{{$error}}
				</li>

			@endforeach
		</ul>
		@endif
	<div class="card card-default">
		
		<div class="card-header" style="font: small-caps bold 30px/1 sans-serif; text-align: center;">
			Edit Discussion : {{$thread->title}}
		</div>
		<div class="card-body">
		
			<form action="{{route('thread.update',['channel'=>$thread->channel->slug , 'thread' => $thread->slug])}}" method="post"
					 role="form" id="create-thread-form">
					 
					{{ csrf_field() }}
					{{method_field('PATCH')}}
					<div class="form-group">
						<input type="text" name="title" class="form-control" value="{{$thread->title}}">
					</div>


					<div class="form-group" >
						<textarea name="body" id="body" cols="5" rows="5" 
						class="form-control" placeholder="ask ...." >{{$thread->body}}</textarea>
					</div>
					

					<div class="from-group">

						<label for="channel">Select a Channel </label>
							<select name="channel_id" id="category" class="form-control">
							@foreach($channels as $channel)
									<option value="{{ $channel->id }}">
										{{ $channel->title }}</option>
							@endforeach
							</select>
					</div>
					
					

					<br>
					
					<div class="form-group"  >
						<div class="text-center">
							<button class="btn btn-success pull-left" style="border-radius:0px;" type="submit">
								Update Thread
							</button>
						</div>
					</div>
			</form>
		</div>
	</div>	
	</div>
	
@stop


@section('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>


    <script>
        $(function () {
            $('#tag').selectize();
        })
    </script>
    
    
@stop




