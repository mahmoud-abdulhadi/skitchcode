<div class="card">
	<div class="card-header">
		<h3>Categories</h3>
	</div>
<ul class="list-group" style="width:100%">
	
	@foreach($categories as $category)

	<li class="list-group-item"><span class="fa fa-bookmark"></span> <a href="/posts/{{$category->slug}}">{{$category->title}}</a></li>

	@endforeach
</ul>
</div>