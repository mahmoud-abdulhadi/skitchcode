@extends('layouts.app')

@section('styles')

<style>
	
	.fa-tags , .fa-tag{

		color : #1D9C73;
	}
	.level {
		display : flex;
	}
	.flex {

		margin-left: auto;
	}
	.fa-trash {

		color :red;


	}

	.fa-trash:hover {

		cursor: pointer;

		
	}
	
	.tags-panel{
		margin : 10px;
		background : #FFF;
	}

	.card-footer .item{

		margin-left : 20px;
	}

	.card-footer .badge {

		padding-left : 10px;

		padding-right: 10px;
	}

	.card .list-group-item {

		background : #333;
	}

	.card-footer a {

		text-decoration: none ; 
	}
</style>

@endsection

@section('content')


<div class="card tags-panel">
	<div class="card-header">
		<h2>Tags Management <span class="fa fa-tags"></span></h2>
		<tags></tags>
	</div>
	
</div>




@endsection


@section('scripts')
<script>
	

	
</script>



@endsection