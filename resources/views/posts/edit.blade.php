@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" href="{{asset('libs/summernote/summernote-bs4.css')}}">
<style>
	
	.card{

		box-shadow: 7px 6px 13px #000;

		padding : 30px;
	}
</style>
@endsection
@section('content')

	

	<div class="card card-default">
		
		<div class="card-header" style="font: small-caps bold 30px/1 sans-serif; text-align: center;">
			Edit Post : {{$post->title}}
		</div>
		<div class="card-body">
		
			<form action="{{ route('post.update',['category'=>$post->category->slug,'post' =>$post->slug])}}" method="post"
					 enctype="multipart/form-data">
					 
					{{ csrf_field() }}	
					{{method_field('PATCH')}}

					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control" 
								value="{{$post->title}}">
					</div>

					<div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" id="content" cols="5" rows="5" 
						class="form-control">{{$post->content}}</textarea>
					</div>

					<div class="form-group">
						<label for="cover">Feature image</label>
						<input type="file" name="cover" class="form-control">
					</div>


					<div class="from-group mb-4">
						<label for="category">Select a Category </label>
							<select name="category_id" id="category" class="form-control">
								@foreach($categories as $category)
									<option value="{{ $category->id }}" >

										@if($post->category->id == $category->id)

											selected

										@endif										
									 
									
									{{ $category->title }}</option>

								@endforeach
							</select>
					</div>

					
					



					<div class="form-group">
						<div class="text-center">
							<button class="btn btn-success pull-left" style="border-radius:0px;" type="submit">
								Update post
							</button>
						</div>
					</div>
			</form>
		</div>
	</div>	
	
@stop


@section('scripts')


<script src="{{asset('libs/summernote/summernote-bs4.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>


    <script>

    	$(document).ready(function() {
  		$('#content').summernote();
		});
		
        $(function () {
            $('#tag').selectize();
        })
    </script>
    
    
@stop