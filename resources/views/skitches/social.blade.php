<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	
	<link href="{{asset('libs/split/jquery.splitter.css')}}" rel="stylesheet"/>
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

          .details {

          	background : #191A1D;
          }

          #details-header {

          		background : #222;
          		width : 90%;

          		padding : 20px;
          		display : flex;
          		flex-wrap: wrap ; 
          		align-items: center ;
          		margin : 0 auto 5px auto;
          		    font-family: "Lato", "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;
          }

          #avatar{

          	width : 60px;
          	height : 60px;
          	margin-right: 15px;
          }

          .by-line{

          	margin : 0 0 3px 0 ;
          	display : flex;
          	align-items: flex-end;
          }
          .name-credit {
          	margin : 0 5px 0 0 ;
          }
          .a-pen-by{
          	text-transform: uppercase;
          	font-size: 0.7rem;
          	letter-spacing: 1px;
          	color : #9396A4;
          }
          .line-title{
          	display: block;
          	color : #9396A4;
          }
          a.skitch-owner-name{
          	font-size : 1.5rem;
          	text-decoration: none;
          	color : #76DAFF;
          }

          #details-header .stats{

          	position: static ; 
          	margin-left: auto;
          	font-size: 1.5rem;
          }

          #details-header .stats .single-stat{

          	font-size: 16px;
          	color : white;
          	margin-right: 10px;
          	display : inline-block;
          	height: 100%;
          	text-align: center;
          	padding : 0 0.625rem 0 0;
          	text-decoration: none;
          }
          .stats .loves {
          	position: relative
          }
          button.invisible-button{


          	border : 0px;
          	background : none;
          }

          #details-description{
          	padding : 40px;
          	display : block;
          	position : relative;
          	background : #32333B;
          	border-radius: 6px;
          	margin : 0 0 20px 0;
          	overflow : hidden;
          }

          .details .details-content{

          	width : 90%;
          	margin :5px auto;
          }

          .details-section-header{
          	color : white;
          	font-weight: 700;
          	margin : 10px 0 5px 0;
          }

          .date-line{
			display : block;
          	color : #A3A6B4;
          }


          .description-time{
          	color :#CCC;
          	text-transform: uppercase;
          	letter-spacing: 0.5px;
          	font-size: 80%;
          }

          .skitch-description{
          	font-size : 1.2em;
          }

          .skitch-description p {
          	color : #9396A4;
          	margin :0 0 1em 0;
          }


          .comments-header{

          	font-size : 1.2rem;
          	font-weight: bold;
          	text-transform: uppercase;
          	line-height: 1.2rem;
          	color : #FFF;
          }

          .all-section{


          	padding-bottom : 50px;
          }

          .all-section .username{
          	width :48%;
          	float : left;
          	margin : 0 2% 2% 0;
          	white-space: nowrap;
          	padding:10px;
          	display : flex;
          	border-radius: 6px;
          	overflow:hidden;
          	background : #32333B;
          }

          .all-section .username .avatar{
          	width : 20px;
          	height: 20px;
          	margin :0 10px 0 0;
          	outline: 0;
          	border:0;
          	max-width: 100%;

          }

          .all-section .username .username-text{
          	overflow:hidden;
          	text-overflow: ellipsis;

          	color : #FFF;

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
				    <a class="dropdown-item" href="{{$skitch->path()}}/full"><span class="fa fa-window-maximize"></span> Full Preview</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}"><span class="fa fa-file-word-o"></span> Work View</a>


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
	

	<div id="main-content">
		<div id="output">
		
		<iframe src="" id="target" scrolling="false" sandbox="allow-popups allow-same-origin allow-scripts allow-modals"></iframe>
		
		</div>
		<div id="app" class="details">
			<div id="details-header">
				<a href="#" id="#details-avatar"><img id="avatar" src="{{$skitch->author->avatar}}" alt="{{$skitch->author->username}}"></a>
				<div class="by-line">
					<div class="name-credit">
						<div class="a-pen-by">
							A Skitch By
						</div>
						<span class="line-title"></span>
						<a href="#" class="skitch-owner-name">{{$skitch->author->name}}</a>
					</div>
				</div>	

				<div class="stats">
					<a href="#" class="single-stat views"><span class="fa fa-eye"></span> {{$skitch->views}}</a>
					<a href="#" class="single-stat comment">
						<span class="fa fa-comment"></span> {{$skitch->commentsCount}}
					</a>
					<button class="invisible-button single-stat loves loved-0"><span class="fa fa-heart"></span> 54</button>
				</div>
			
			</div>
			<div class="row details-content">
				<div class="col-sm-8">
					<div class="details-section-header">Description</div>
					<div id="details-description">
						<div class="description">
							<div class="skitch-description">
								@if($skitch->is_forked)
									<p>This Skitch is forked , 
										@if($skitch->forkable_id != null)
										<a href="{{$skitch->forkable->path()}}">{{$skitch->forkable->title}}</a>
										@else
										,but the parent Skitch has been Deleted.
										@endif
									</p>
								@endif
								<p>{{$skitch->description}}</p>
							</div>
							<div class="date-line">
								<span>Created</span> <span class="description-time">{{$skitch->created_at->toFormattedDateString()}}</span>
								
							</div>
						</div>
						
					</div>
					<div class="comments">
					<h2 class="comments-header">Comments</h2>
						No Comments yet
					</div>
				</div>
				<div class="col-sm-4">
					<div class="row">
						<div class="col-sm-12">
							<div class="details-section-header">Likes</div>
							<div class="all-section">

								<a href="#" class="username">
									<img src="https://i2.wp.com/codepen.io/assets/avatars/user-avatar-512x512-6e240cf350d2f1cc07c2bed234c3a3bb5f1b237023c204c782622e80d6b212ba.png?ssl=1" alt="" class="avatar">
									<span class="username-text">Mahmoud Abdulhadi</span>
								</a>
								<a href="#" class="username">
									<img src="https://i2.wp.com/codepen.io/assets/avatars/user-avatar-512x512-6e240cf350d2f1cc07c2bed234c3a3bb5f1b237023c204c782622e80d6b212ba.png?ssl=1" alt="" class="avatar">
									<span class="username-text">Abdulkadir</span>
								</a>

								
							</div>
						</div>
						<div class="col-sm-12">
							<div class="details-section-header">
								Forks
							</div>
							<div class="all-section">
								@foreach($skitch->forks as $fork)
								<a href="{{$fork->path()}}" class="username">
									<img src="{{$fork->author->avatar}}" alt="" class="avatar">
									<span class="username-text">{{$fork->author->name}}</span>
								</a>
								@endforeach
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
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



		


	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	






	

	


	
	
	@include('includes.scripts.extractScript')
	<script src="{{asset('libs/split/jquery.splitter.js')}}"></script>
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
	
<script src="/js/social_skitch.js"></script>

</body>
</html>

