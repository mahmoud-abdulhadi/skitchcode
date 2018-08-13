<li v-for="item in item.children"><a href="#">@{{item.name}}</a>


	<ul v-if="item.isFolder">
		@include('projects.partials.item')

	</ul>
</li>

