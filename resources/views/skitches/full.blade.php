<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/code.css')}}">
	@include('includes.styles.themes')
	<script>
	window.App = {!!
          json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check(),
            'authorized' => Auth::id() == $skitch->user_id
            ])

        !!};
     </script>
     <style>
			


          .fa-code{

            color:#0EBEFF;
            border-radius:5px;
            padding:5px;
            background :#000;
          }

          .new-item{

            font-weight: bold;
          }
          .fa-file-code-o{

            color : #FCD000;
            border-radius:5px;
            padding:5px;
            background :#000;
          }

          .fa-book{
            color : #47CF73;
            border-radius:5px;
            padding:5px;
            background :#000;

          }

          .fa-comments {
              color : #AE63E4;
              border-radius:5px;
              padding:5px;
              background :#000;

          }
          .fa-desktop{
	
			color : #D11F5D;
          }

          #avatar-dropdown .dropdown-menu{

          	margin-left : -85px;
          }
     </style>
	<title>Skitch Code</title>
</head>
<body>
		<!-- Modal -->
		@include('includes.modals.htmlSettings')
		@include('includes.modals.cssSettings')
		@include('includes.modals.jsSettings')
		@include('includes.modals.globalSettings')
			<!-- Confirm Deletion Modal -->
			<div class="modal fade show confirm" id="deleteSkitch" tabindex="-1" role="dialog" aria-labelledby="Delete Skitch">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      
			      <div class="modal-body">
			        <h2>Are you sure you want to Delete {{$skitch->title}}?</h2>
			        <p>This Skitch Will be Permenantly Deleted.</p>
			        <form id="delete-skitch-form" action="{{$skitch->path()}}" method = "POST">
			        	{{csrf_field()}}
			        	{{method_field('DELETE')}}
			        <button type="reset" class="btn cancel-button mr-3" data-dismiss="modal">Cancel</button>
			        
			        <button type="submit" class="btn close-file" id="confirm-delete-skitch" >Delete Skitch</button>
			        </form>
			      </div>
			      
			    </div>
			  </div>
	</div>
	<!-- Main Content -->
	<div id="skitch-header">
	<div class="row pt-2">
		
	
		<div class="col-md-3">
			<h4 id="skitch-title">{{$skitch->title}}</h4>
			<div id="skitch-author">Created By <span class="fa fa-user-circle"></span> {{$skitch->author->name}}</div>

		</div>
		<div class="col-md-2 text-right">
			<div class="dropdown text-right" id="browse-dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="browse-dropdown-btn"  aria-haspopup="true" aria-expanded="false">
				   <span class="fa fa-desktop"></span> Browse
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	
				    <a class="dropdown-item" href="/skitches"><span class="fa fa-code"></span>  Explore Skitches</a>
				    <a class="dropdown-item" href="/workspaces"> <span class="fa fa-file-code-o"></span>  Explore Workspaces</a>
				    <a class="dropdown-item" href="/posts"><span class="fa fa-book"></span>  Read Posts</a>
				    <a class="dropdown-item" href="/threads"><span class="fa fa-comments"></span>  View Discussions</a>


				  </div>		
	

		</div>
</div>
		@if(Auth::check())
		<div class="col-md-2">
				<div class="dropdown" id="mywork-dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="mywork-dropdown-btn"  aria-haspopup="true" aria-expanded="false">
				   <span class="fa fa-pencil"></span> My Work
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	
				    <a class="dropdown-item" href="/skitches/{{Auth::user()->username}}"><span class="fa fa-code"></span>  My Skitches</a>
				    <a class="dropdown-item" href="/workspaces/{{Auth::user()->username}}"> <span class="fa fa-file-code-o"></span>  My Workspaces</a>
				    <a class="dropdown-item" href="/posts?by={{Auth::user()->username}}"><span class="fa fa-book"></span>  My Posts</a>
				    <a class="dropdown-item" href="/threads?by={{Auth::user()->username}}"><span class="fa fa-comments"></span>  My Discussions</a>


				  </div>
			</div>
			</div>
		
		<div class="col-md-1 text-right">
			<form action="{{$skitch->path()}}/forks" method="post">
				{{csrf_field()}}
			<button class="btn btn-secondary" id="fork-btn" type="submit"><span class="fa fa-code-fork fa-lg"></span> Fork</button>
			</form>
		</div>
		<div class="col-md-1 text-right">
			
			<button class="btn btn-secondary" id="like-btn"><span class="fa fa-heart fa-lg"></span></button>
		</div>
		@endif
		<div class="col-md-2">
			<div class="dropdown text-right" id="view-dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="view-dropdown-btn"  aria-haspopup="true" aria-expanded="false">
				   <span class="fa fa-eye"></span> Change View
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	 <h5 class="dropdown-header">Code Raw Links</h5>
				    <a class="dropdown-item" href="{{$skitch->path()}}/html">.HTML</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}/css">.CSS</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}/js">.js</a>
				    <h5 class="dropdown-header">Other Views</h5>
				    <a class="dropdown-item" href="#"><span class="fa fa-window-maximize"></span> Full Preview</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}"><span class="fa fa-file-word-o"></span> Work View</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}/social"><span class="fa fa-comment-o"></span>	Social View</a>


				  </div>
			</div>
		</div>
		
		@if(Auth::check())
		<div class="col-md-1 text-right">
			<div class="dropdown text-right" id="avatar-dropdown">
				  <a  type="button" id="avatar-dropdown-btn"  aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
				   <img id="avatar-top" src="{{Auth()->user()->avatar}}">
				  </a>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	 <h5 class="dropdown-header">Create..</h5>
				    <a class="dropdown-item" href="/skitch"><span class="fa fa-code"></span> New Skitch</a>
				    <a class="dropdown-item" href="/workspaces/create"><span class="fa fa-file-code-o"></span> New Worksapce</a>
				    <a class="dropdown-item" href="#"><span class="fa fa-book"></span> New Post</a>
				    <a class="dropdown-item" href="#"><span class="fa fa-comments"></span> New Discussion</a>
				    <h5 class="dropdown-header">{{Auth::user()->name}}</h5>
				    <a class="dropdown-item" href="#"><span class="fa fa-tachometer"></span>   Dashboard</a>
				    <a class="dropdown-item" href="#"><span class="fa fa-user"></span> Profile</a>
				    <a class="dropdown-item" href="#"> <span class="fa fa-feed"></span> Activity</a>
				    <div class="dropdown-divider"></div>
				    <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                        <span class="fa fa-sign-out"></span> Logout
                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>



				  </div>
			</div>
			@else
					<div class="col-md-1 offset-md-3"></div> 
					<div class="dropdown text-right" id="avatar-dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="avatar-dropdown-btn"  aria-haspopup="true" aria-expanded="false">
				   <span class="fa fa-user"></span>
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	
				    <a class="dropdown-item" href="/login"><span class="fa fa-sign-in"></span>Log In</a>
				    <a class="dropdown-item" href="/register"><span class="fa fa-user-plus"></span> Sign Up</a>
				  


				  </div>		
	

		</div>
</div>
			@endif
			</div>
		
	</div>
	</div>
	</div>
	


	<div id="output">
	
	<iframe src="" id="target" scrolling="false" sandbox="allow-popups allow-same-origin allow-scripts allow-modals"></iframe>
	
	</div>

</div>
<div class="row">
	<div class="col-12">
			<div id="footerPanel">
					@can('delete',$skitch)
			
						<button  class="btn btn-sm" id="deleteBtn">Delete</button>
						
				
					@endcan
		
			</div>

	</div>
</div>

</div>

		


	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	






	

	


	
	
	@include('includes.scripts.extractScript')
	<!-- Custome Scripts -->
	<script type="text/javascript" src="{{asset('js/full_code.js')}}"></script>
	
		

		


		
	<script>

		
		$('#deleteBtn').on('click',function(e){

		$('#deleteSkitch').modal();

	});
		$('#view-dropdown-btn').on('click',function(){


		$('#view-dropdown .dropdown-menu').slideToggle();

	});

	$('#mywork-dropdown-btn').on('click',function(){


		$('#mywork-dropdown .dropdown-menu').slideToggle();

	});

	$('#browse-dropdown-btn').on('click',function(){


		$('#browse-dropdown .dropdown-menu').slideToggle();

	});

	$('#avatar-dropdown-btn').on('click',function(e){

		e.preventDefault();

		$('#avatar-dropdown .dropdown-menu').slideToggle();

	});

	$('document').ready(function(){


		runCode();
	});

		

	
</script>
	


</body>
</html>

