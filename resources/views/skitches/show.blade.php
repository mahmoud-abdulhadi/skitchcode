<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	
	<link rel="stylesheet" type="text/css" href="{{asset('css/libs/codemirror.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/theme/monokai.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/theme/material.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/theme/dracula.css')}}">
	<link rel="stylesheet" type="text/css" href="/fonts_libs/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('libs/fullscreen/fullscreen.css')}}">
	<link rel="stylesheet" href="{{asset('libs/hint/show-hint.css')}}">
	<link rel="stylesheet" href="{{asset('libs/lint/lint.css')}}">
	<link rel="stylesheet" href="{{asset('libs/fold/foldgutter.css')}}">
	<link rel="stylesheet" href="{{asset('libs/scrolls/simplescrollbars.css')}}">
	<link href="{{asset('libs/split/jquery.splitter.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/code.css')}}">
	<link rel="stylesheet" href="{{asset('libs/search/dialog.css')}}">
	<link rel="stylesheet" href="{{asset('libs/search/matchesonscrollbar.css')}}">

	<link rel="stylesheet" href="{{asset('libs/analysis/tern.css')}}">
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
				    <a class="dropdown-item" href="{{$skitch->path()}}/full"><span class="fa fa-window-maximize"></span> Full Preview</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}"><span class="fa fa-file-word-o"></span> Work View</a>
				    <a class="dropdown-item" href="{{$skitch->path()}}/social"><span class="fa fa-comment-o"></span> Social View</a>


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
				    <a class="dropdown-item" href="/posts/create"><span class="fa fa-book"></span> New Post</a>
				    <a class="dropdown-item" href="/threads/create"><span class="fa fa-comments"></span> New Discussion</a>
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
	<div class="row" id="control-section">
		
		<div  class="col" id="control-panel">
			<button data-target="#globalSettings" data-toggle="modal" id="settings-btn-show">
				<span class="fa fa-gear"></span> Settings

			</button>
			<button class="btn btn-md" id="download-button"><span class="fa fa-download"></span>&nbsp;Download</button>
			<div id="auto-check-choice">
				<span id="check-label">Auto Preview</span>
				<div class="material-switch" style="display:inline">
                    <input id="runChoice" name="runChoice" type="checkbox"/>
                    <label for="runChoice" class="label-primary"></label>
             	</div>
             </div>
				@can('update',$skitch)
				<button class="btn btn-md" id="saveBtn"><span class="fa fa-cloud"></span>&nbsp;Save</button>


			
			
			<button class="btn btn-md" id="resetBtn"><span class="fa fa-eraser"></span>&nbsp;Reset</button>
			@endcan
		
			<button class="btn btn-dark btn-md" id="btnRun"><span class="fa fa-terminal"></span>&nbsp;Run</button>
			<button class="btn btn-md" id="refreshBtn"><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
		</div>
	</div>
	<div id="editorContainer">
		<div  id="editorPlay">
			<div  id="design-editors">
			<div  id="editor1">	
			<div class="editorHeader">
				<h1 class="editor-title">HTML</h1>
			<a type="button" href="#htmlSettings" data-toggle="modal" data-target="#htmlSettings"><span class="fa fa-gear"></span></a>
			</div>	
			<textarea class="editor" id="htmlEditor"></textarea>

			</div>

			<div id="editor2">
			<div class="editorHeader">
				<h1 class="editor-title">CSS</h1>
			<a type="button" href="#cssSettings" data-toggle="modal" data-target="#cssSettings"><span class="fa fa-gear"></span></a>
			</div>
			<textarea class="editor" id="cssEditor"></textarea>

			</div>
			</div>
			<div id="code-editor">
			<div  id="editor3">
				<div class="editorHeader">
					<h1 class="editor-title">JavaScript</h1>
				<a type="button" href="jsSettings" data-toggle="modal" data-target="#jsSettings"><span class="fa fa-gear"></span></a>
				</div>
			<textarea class="editor" id="jsEditor"></textarea>

			</div>
			</div>
		
		</div>

	<div id="output">
		<div class="editorHeader">
								
									<h1 class="editor-title">Output</h1>
									
		</div>
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

		

	<script type="text/javascript" src="{{asset('js/libs/codemirror.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/xml/xml.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/css/css.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/javascript/javascript.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/libs/split/split.min.js')}}"></script>

	<script src="{{asset('js/libs/emmet.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	<script src="{{asset('libs/split/jquery.splitter.js')}}"></script>
	<script src="{{asset('libs/fullscreen/fullscreen.js')}}"></script>
	<script src="{{asset('libs/fold/xml-fold.js')}}"></script>
	<script src="{{asset('libs/edit/closebrackets.js')}}"></script>

	<script src="{{asset('libs/edit/closetag.js')}}"></script>
	<script src="{{asset('libs/edit/matchtags.js')}}"></script>
	<script src="{{asset('libs/lint/jshint.js')}}"></script>
	<script src="{{asset('libs/lint/lint.js')}}"></script>
	<script src="{{asset('libs/lint/javascript-lint.js')}}"></script>

	<!-- CSS lint dependencies -->
	<script src="{{asset('libs/lint/csslint.js')}}"></script>
	<script src="{{asset('libs/lint/css-lint.js')}}"></script>


	<!-- HTML Lint Dependecies -->
	<script src="{{asset('libs/lint/htmlhint.js')}}"></script>
	<script src="{{asset('libs/lint/html-lint.js')}}"></script>

	<script src="{{asset('libs/selection/active-line.js')}}"></script>
	<script src="{{asset('libs/selection/mark-selection.js')}}"></script>

	<!-- Analysis -->
	<script src="{{asset('libs/analysis/tern.js')}}"></script>

	<script src="{{asset('libs/analysis/acorn.js')}}"></script>
	<script src="{{asset('libs/analysis/acorn_loose.js')}}"></script>
	<script src="{{asset('libs/analysis/walk.js')}}"></script>
	<script src="{{asset('libs/analysis/polyfill.js')}}"></script>
	<script src="{{asset('libs/analysis/signal.js')}}"></script>
	<script src="{{asset('libs/analysis/ternNet.js')}}"></script>
	<script src="{{asset('libs/analysis/def.js')}}"></script>
	<script src="{{asset('libs/analysis/comment.js')}}"></script>
	<script src="{{asset('libs/analysis/infer.js')}}"></script>
	<script src="{{asset('libs/analysis/doc_comment.js')}}"></script>



	<!-- AutoComplete Dependencies --> 

	<script src="{{asset('libs/hint/show-hint.js')}}"></script>

	<script src="{{asset('libs/hint/javascript-hint.js')}}"></script>

	<script src="{{asset('libs/hint/css-hint.js')}}"></script>

	<script src="{{asset('libs/hint/html-hint.js')}}"></script>

	<script src="{{asset('libs/hint/xml-hint.js')}}"></script>
	
	<script src="{{asset('libs/hint/anyword-hint.js')}}"></script>


	<!-- Code Folding --> 
	<script src="{{asset('libs/fold/foldcode.js')}}"></script>
	<script src="{{asset('libs/fold/foldgutter.js')}}"></script>
	<script src="{{asset('libs/fold/brace-fold.js')}}"></script>
	<script src="{{asset('libs/fold/comment-fold.js')}}"></script>


	<!-- Scrollbars --> 
	<script src="{{asset('libs/scrolls/simplescrollbars.js')}}"></script>
	<!-- Search --> 
	<script src="{{asset('libs/search/search.js')}}"></script>
	<script src="{{asset('libs/search/searchcursor.js')}}"></script>
	<script src="{{asset('libs/search/matchesonscrollbar.js')}}"></script>
	<script src="{{asset('libs/search/jump-to-line.js')}}"></script>
	<script src="{{asset('libs/search/dialog.js')}}"></script>
	<script src="{{asset('libs/search/annotatescrollbar.js')}}"></script>

	
	
	<!-- Save code --> 
	<script src="{{asset('js/libs/savecode.js')}}"></script>
	<!-- Custome Scripts -->
	<script type="text/javascript" src="{{asset('js/code.js')}}"></script>
	
		

		@include('includes.scripts.showScript')


		
	<script>
		var skitchTitle ; 

		var skitchDescription ; 

		var oldSize = $('.CodeMirror').css('font-size');

		var htmlOldSize = $('#editor1 .CodeMirror').css('font-size');

		var cssOldSize = $('#editor2 .CodeMirror').css('font-size');

		var jsOldSize = $('#editor3 .CodeMirror').css('font-size');
		$('document').ready(function(){


			runCode();

			skitchTitle = '<?= $skitch->title ?>' ; 


			skitchDescription = '<?=$skitch->description ?>' ; 


			 function getURL(url, c) {
				    var xhr = new XMLHttpRequest();
				    xhr.open("get", url, true);
				    xhr.send();
				    xhr.onreadystatechange = function() {
				      if (xhr.readyState != 4) return;
				      if (xhr.status < 400) return c(null, xhr.responseText);
				      var e = new Error(xhr.responseText || "No response");
				      e.status = xhr.status;
				      c(e);

				      xhr.close();
				    };
				  }	

 		 var server;
  	getURL("//ternjs.net/defs/ecmascript.json", function(err, code) {
    	if (err) throw new Error("Request for ecmascript.json: " + err);
    	server = new CodeMirror.TernServer({defs: [JSON.parse(code)]});
   	 jsEditor.setOption("extraKeys", {
    	  "Ctrl-B": function(cm) { server.complete(cm); },
      		"Ctrl-I": function(cm) { server.showType(cm); },
      		"Ctrl-O": function(cm) { server.showDocs(cm); },
      	"Alt-.": function(cm) { server.jumpToDef(cm); },
      	"Alt-,": function(cm) { server.jumpBack(cm); },
      	"Ctrl-Q": function(cm) { server.rename(cm); },
      	"Ctrl-.": function(cm) { server.selectName(cm); }
    		})
    jsEditor.on("cursorActivity", function(cm) { server.updateArgHints(cm); });
  	});

		});

		$('#deleteBtn').on('click',function(e){

		$('#deleteSkitch').modal();

	});


	if("{{Session::has('flash')}}"){
		alertify.logPosition('top right');
		window.alertify.success("{{Session::get('flash')}}") ; 
	}


	//code to update code using axios 

	function axiosSaveCode(){


	}

	$('#saveBtn').on('click',function(){


		var url = '/skitches/{{$skitch->id}}' ; 
		var source = JSON.stringify({

			html :  htmlEditor.getValue(), 
			css : cssEditor.getValue(), 
			js :  jsEditor.getValue(),


		});


		axios.put(url,{code : source , title : skitchTitle , description : skitchDescription})
			.then(function(response){
				data = response.data ;

				console.log(data); 

				var skitchTitleElement = document.querySelector('#skitch-title');

				skitchTitleElement.textContent = data.title ; 


				htmlCode = JSON.parse(data.code).html ; 

				cssCode = JSON.parse(data.code).css ; 

				jsCode = JSON.parse(data.code).js ; 


				htmlEditor.setValue(htmlCode);

				cssEditor.setValue(cssCode);

				jsEditor.setValue(jsCode);

				alertify.logPosition('top right');
				alertify.success('Skitch Updated Succesfully!!');



			});


	});



	$('#font-size-html-up').on('click',function(){

			var currentSize = $('#editor1 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 1.1 ; 


			$('#editor1 .CodeMirror').css('font-size',currentSize);

		});

	$('#font-size-html-down').on('click',function(){

			var currentSize = $('#editor1 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 0.95 ; 

			$('#editor1 .CodeMirror').css('font-size',currentSize);
			
		});
	$('#font-size-css-up').on('click',function(){

			var currentSize = $('#editor2 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 1.1 ; 


			$('#editor2 .CodeMirror').css('font-size',currentSize);

		});

	$('#font-size-css-down').on('click',function(){

			var currentSize = $('#editor2 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 0.95 ; 

			$('#editor2 .CodeMirror').css('font-size',currentSize);
			
		});
	$('#font-size-js-up').on('click',function(){

			var currentSize = $('#editor3 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 1.1 ; 


			$('#editor3 .CodeMirror').css('font-size',currentSize);

		});

	$('#font-size-js-down').on('click',function(){

			var currentSize = $('#editor3 .CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 0.95 ; 

			$('#editor3 .CodeMirror').css('font-size',currentSize);
			
		});
	$('#font-size-up').on('click',function(){

			var currentSize = $('.CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 1.1 ; 


			$('.CodeMirror').css('font-size',currentSize);

		});

	$('#font-size-down').on('click',function(){

			var currentSize = $('.CodeMirror').css('font-size');

			//save currentSize In new variabel 

			currentSize = parseFloat(currentSize);

			currentSize *= 0.95 ; 

			$('.CodeMirror').css('font-size',currentSize);
			
		});



	$('#global-settings-save-button').on('click',function(){

		 skitchTitle = $('#title').val();

		 skitchDescription = $('#description').val();

		


		oldSize = $('.CodeMirror').css('font-size');



		 $('#globalSettings').modal('hide');

});

	$('#global-settings-close-button').on('click',function(){


		$('.CodeMirror').css('font-size',oldSize);

		$('#globalSettings').modal('hide');

	});

	$('#js-settings-save-button').on('click',function(){

		

		


		oldSize = $('#editor3 .CodeMirror').css('font-size');



		 $('#jsSettings').modal('hide');

});


	$('#js-settings-close-button').on('click',function(){


		$('#editor3 .CodeMirror').css('font-size',oldSize);

		$('#jsSettings').modal('hide');

	});


		$('#css-settings-save-button').on('click',function(){

		 
		


		oldSize = $('#editor2 .CodeMirror').css('font-size');



		 $('#cssSettings').modal('hide');

});


	$('#css-settings-close-button').on('click',function(){


		$('#editor2 .CodeMirror').css('font-size',oldSize);

		$('#cssSettings').modal('hide');

	});
		$('#html-settings-save-button').on('click',function(){

		
		


		oldSize = $('#editor1 .CodeMirror').css('font-size');



		 $('#htmlSettings').modal('hide');

});


	$('#html-settings-close-button').on('click',function(){


		$('#editor1 .CodeMirror').css('font-size',oldSize);

		$('#htmlSettings').modal('hide');

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

	
</script>
	


</body>
</html>

