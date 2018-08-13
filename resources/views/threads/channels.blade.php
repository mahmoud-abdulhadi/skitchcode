<ul class="list-group">
	
	@foreach($channels as $channel)

	<li class="list-group-item"><span class="fa fa-certificate"></span> <a href="/threads/{{$channel->slug}}">{{$channel->title}}</a></li>

	@endforeach
</ul>