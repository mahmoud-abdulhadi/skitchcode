@extends('layouts.app')

@section('styles')

	<style>

		.card{

			box-shadow: 7px 6px 13px #000;
		}
	</style>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-9 offset-md-3">
			<div class="card">
					<div class="card-header">
						<h1>Channels</h1>
					</div>

				<div class="card-body">
					<channels></channels>
				</div>
			</div>
	</div>
</div>
	
@endsection