@extends('layouts.app')

@section('styles')




<link rel="stylesheet" href="{{asset('libs/summernote/summernote-bs4.css')}}">


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
	<div class="card card-default"  >
		
		<div class="card-header" style="font: small-caps bold 30px sans-serif;text-align: center;">
			Create new post 
		</div>
		<hr>
		<div class="card-body">
		
			<form action="{{ route('post.store')}}" method="post"
					 enctype="multipart/form-data">
					 
					{{ csrf_field() }}

					<div class="form-group">
			
						<input type="text" name="title" class="form-control" placeholder="Title..">
					</div>
					<div class="form-group" >
						
						<textarea name="content" id="content" cols="5" rows="5" 
						class="form-control" ></textarea>

					
					</div>
					<div class="form-group">
						<label for="cover"><h5>Feature image</h5></label>
						<input type="file" name="cover" class="form-control" >
						
					</div>

					<div class="from-group">

						<label for="category"><h5>Select a Category</h5> </label>
							<select name="category_id" id="category" class="form-control">
							@foreach($categories as $category)
									<option value="{{ $category->id }}">
										{{ $category->title }}</option>

								@endforeach
							</select>
					</div>
					

                <!-- Selectize -->
					{{-- <div class="form-group">
                   	<br>
                   	<label for="category"><h5>put Tags :</h5> </label>
                    <select name="tags[]" multiple id="tag" placeholder="Put tags">
                       
                        @foreach($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>--}}
                	<!-- end -->


					<br>
					
					<div class="form-group"  >
						<div class="text-center">
							<button class="btn btn-success pull-left" style="border-radius: 0px;"  type="submit">
								store post
							</button>
						</div>
					</div>
			</form>
		</div>
	</div>	
	</div>
	
@stop




@section('scripts')
<!-- Include jQuery lib. -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

<script src="{{asset('libs/summernote/summernote-bs4.js')}}"></script>


    
    <script>

   $(document).ready(function() {
  	$('#content').summernote();
	});


    
        $(function () {
            $('#tag').selectize();
        });
   
       
    </script>
    
@stop




