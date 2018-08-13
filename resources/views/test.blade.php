<!DOCTYPE html>
<html>
<head>
	<!--<link rel="stylesheet" type="text/css" href="/css/libs/bulma.css">-->


	<link rel="stylesheet" type="text/css" href="/fonts_libs/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="/css/libs/codemirror.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<!-- Code Editor Themes --> 

	<link rel="stylesheet" type="text/css" href="/css/theme/monokai.css">

	
	
	<title>Create new Skitch</title>
</head>
<body>
	<!---
	<nav class="navbar is-black" role="navigation">
			<div class="navbar-brand">
				
				<a class="navbar-item" href="/">
					<img src="/imgs/logo2.png" >
					<h1>Skitch Code</h1>
				</a>
			</div>

			<div class="navbar-menu">
				<div class="navbar-start">
					<a class="navbar-item is-dark" id="postsLink">
					 Posts</a>

					 <a class="navbar-item is-dark" id="discussionsLink">
					 Discussions</a>

					 <a class="navbar-item is-dark" id="skitchesLink">
					 Skitches</a>
				</div>
				<div class="navbar-end">
					<div class="navbar-item has-dropdown is-hoverable" id="createButton">
						<a class="navbar-link" href="#">
							Create
        				  
       					 </a>


       					 <div class="navbar-dropdown">
       					 	<a class="navbar-item"> <span class="icon" style="color : blue">
                <i class="fa fa-code"></i>
              </span>New Sktich</a>

       					 	<a class="navbar-item"><span class="icon" style="color:green"><i class="fa fa-book"></i></span>New Post</a>


       					 </div>
					
						
					

					</div>
					<a class="navbar-item">
						<button class="button is-medium">Login</button>
					</a>


					<a class="navbar-item">
						<button class="button is-medium">
							Register
						</button>
					</a>




				</div>
			</div>
	</nav>
	
	<nav class="navbar is-dark" id="secondaryNav">
		

		<div class="navbar-menu">
			<div class="navbar-end">
				
				<div class="navbar-item">
					<button class="button is-medium command" id="runButton"><span style="color:#AAA"><i class="fa fa-terminal"  aria-hidden="true"></i></span>&nbsp;&nbsp;Run</button>
				</div>

				<div class="navbar-item">
					<button class="button is-medium command"><span style="color:#AAA"><i class="fa fa-cloud "></i></span>&nbsp;&nbsp;Save</button>
				</div>
				<div class="navbar-item">
					<button class="button is-medium command"><span style="color:#AAA"><i class="fa fa-code-fork"></i></span>&nbsp;&nbsp;Fork</button>
				</div>

				<div class="navbar-item">
					<button class="button is-medium options"><span style="color:#AAA"><i class="fa fa-gear"></i></span>&nbsp;&nbsp;Settings</button>
				</div>

				<div class="navbar-item">
					<button class="button is-medium options"><span style="color:#AAA"><i class="fa fa-eye"></i></span>&nbsp;&nbsp;Change Prespective</button>
				</div>

			</div>

		</div>

	</nav>-->
	

		
	
	<div id="editor1" class="editor" style="float:left;width:33%">
	<textarea  id="htmlEditor">
		
	</textarea>

	</div>

	
	

	<div id="editor2" class="editor" style="float:left;width:33%">
		<textarea id="cssEditor">
			
		</textarea></div>
	



	<div id="editor3" class="editor" style="float:left;width:33%">
	<textarea  id="jsEditor">
		
	</textarea>
	</div>








	
		<iframe id ="target" src="" sandbox="allow-scripts allow-modals allow-popups allow-same-origin"></iframe>
	
	
	



		

	<!--
		<nav class="navbar is-dark is-fixed-bottom" id="third">

			<div class="navbar-menu">
				
				<div class="navbar-start"></div>


				<div class="navbar-end">
					<div class="navbar-item">
						<button class="button"><i class="fa fa-external-link"></i></button>
					</div>
					<div class="navbar-item">
						<button class="button" id="deleteButton"><i class="fa fa-trash fa-sm"></i>&nbsp;Delete</button>
					</div>
					<div class="navbar-item">
						<button class="button">Embed</button>
					</div>
				</div>
			</div>
				

		</nav>
	
-->

		<script type="text/javascript" src="{{asset('js/libs/jquery.min.js')}}"></script>

		


		<script type="text/javascript" src="{{asset('js/libs/codemirror.js')}}"></script>

		<script type="text/javascript" src="{{asset('js/libs/css/css.js')}}"></script>

		<script type="text/javascript" src="{{asset('js/libs/javascript/javascript.js')}}"></script>

		<script type="text/javascript" src="{{asset('js/libs/xml/xml.js')}}"></script>

		<script type="text/javascript" src="{{asset('js/libs/split/split.min.js')}}"></script>

				<script type="text/javascript" src="{{asset('js/test.js')}}"></script>


		
			
			
		


</body>
</html>