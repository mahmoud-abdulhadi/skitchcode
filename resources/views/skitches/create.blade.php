<!DOCTYPE html>
<html>
<head>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

	
	<link rel="stylesheet" type="text/css" href="{{asset('css/libs/codemirror.css')}}">
	
	<link rel="stylesheet" type="text/css" href="/fonts_libs/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('libs/lint/lint.css')}}">

	<link rel="stylesheet" href="{{asset('libs/hint/show-hint.css')}}">


	<link rel="stylesheet" href="{{asset('libs/fold/foldgutter.css')}}">
	<link rel="stylesheet" href="{{asset('libs/scrolls/simplescrollbars.css')}}">
	
    <link href="{{asset('libs/split/jquery.splitter.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('libs/fullscreen/fullscreen.css')}}">
	
	@include('includes.styles.themes')
	<link rel="stylesheet" type="text/css" href="{{asset('css/code.css')}}" />

		<link rel="stylesheet" href="{{asset('libs/search/dialog.css')}}">
	<link rel="stylesheet" href="{{asset('libs/search/matchesonscrollbar.css')}}">

	<link rel="stylesheet" href="{{asset('libs/analysis/tern.css')}}">

	<script type="text/javascript">
		
		window.App = {!!

				json_encode([
					'authorized' => true

					]);

			!!}
	</script>
	
	<title>Skitch Code</title>
</head>
<body>
	
<!-- Modal -->
	@include('includes.modals.htmlSettings')
	@include('includes.modals.cssSettings')
	@include('includes.modals.jsSettings')
	<div class="modal fade show save" id="saveSkitch" tabindex="-1" role="dialog" aria-labelledby="Delete Skitch">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">

			      	<h4><span class="fa fa-cogs"></span> Skitch Settings</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>
			      <div class="modal-body">
			       	<form id="save-form" action="{{route('code.store')}}" method="post">
			       		{{csrf_field()}}
			       		<div class="form-group">
			       			<label for="title"><strong>Title:</strong></label>
			       			<input type="text" class="form-control" id="title" name="title" placeholder="New Skitch Title" required>

			       		</div>
			       		<div class="form-group">
			       			<label for="description"><strong>Description:</strong></label>
			       			<textarea name="description" id="description"  class="form-control"></textarea>
			       		</div>
						<hr>
						<div class="form-group">
							<button  class="btn btn-success" id="save-skitch-button">Save</button>
							<button class="btn btn-default" data-dismiss="modal" id="cancel-save-button">Cancel</button>
						</div>

			       	</form>
			      
			        
			      </div>
			      
			    </div>
			  </div>
	</div>
	
	<div class="row">
		
		<div  class="col" id="control-panel">
			<div id="auto-check-choice">
				<span id="check-label">Auto Preview</span>
				<div class="material-switch" style="display:inline">
                    <input id="runChoice" name="runChoice" type="checkbox"/>
                    <label for="runChoice" class="label-primary"></label>
             	</div>
             </div>
             <button class="btn btn-md" id="download-button"><span class="fa fa-download"></span>&nbsp;Download</button>
			
				<button class="btn btn-md" id="saveBtn"><span class="fa fa-cloud"></span>&nbsp;Save</button>
		
			
			<button class="btn btn-md" id="resetBtn"><span class="fa fa-eraser"></span>&nbsp;Reset</button>
			<button class="btn btn-dark btn-md" id="btnRun"><span class="fa fa-terminal"></span>&nbsp;Run</button>
		</div>
	</div>	

		<div id="editorContainer">
		<div  id="editorPlay">
			
					<div id="design-editors">
				
					<div id="editor1">	

								<div class="editorHeader">
								
									<h1 class="editor-title">HTML</h1>
									<a type="button" href="#htmlSettings" data-toggle="modal" data-target="#htmlSettings"><span class="fa fa-gear"></span></a>
								</div>	
								<textarea class="editor" id="htmlEditor"></textarea>
				
					</div>
				
								<div  id="editor2">
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
							<a type="button" href="#jsSettings" data-toggle="modal" data-target="#jsSettings"><span class="fa fa-gear"></span></a>

						</div>
					<textarea class="editor" id="jsEditor"></textarea>

					</div>
				</div>
			</div>
			
			
			
	

	<div id="output">
		<div class="editorHeader">
								
									<h1 class="editor-title">Output</h1>
									
		</div>	
	<iframe src="" id="target" sandbox="allow-forms allow-modals allow-popups allow-same-origin allow-scripts" scrolling="false"></iframe>
	
	</div>
</div>


		
	
		<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

	<script type="text/javascript" src="{{asset('js/libs/codemirror.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/xml/xml.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/css/css.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/libs/javascript/javascript.js')}}"></script>


	<script src="{{asset('js/libs/emmet.js')}}"></script>




	<script src="{{asset('libs/split/jquery.splitter.js')}}"></script>

	<script src="{{asset('libs/fullscreen/fullscreen.js')}}"></script>
	<script src="{{asset('libs/edit/closebrackets.js')}}"></script>
	<script src="{{asset('libs/fold/xml-fold.js')}}"></script>
	<script src="{{asset('libs/edit/closetag.js')}}"></script>
	<script src="{{asset('libs/edit/matchtags.js')}}"></script>
	<script src="{{asset('libs/lint/jshint.js')}}"></script>

	<script src="{{asset('libs/lint/lint.js')}}"></script>
	<script src="{{asset('libs/lint/javascript-lint.js')}}"></script>

	<!-- Css Lint Dependencies  -->
	<script src="{{asset('libs/lint/csslint.js')}}"></script>
	<script src="{{asset('libs/lint/css-lint.js')}}"></script>

	<!-- HTML Lint Dependecies -->
	<script src="{{asset('libs/lint/htmlhint.js')}}"></script>
	<script src="{{asset('libs/lint/html-lint.js')}}"></script>

	<!-- Hard Wrapping Dependency --> 
	<script src="{{asset('libs/wrap/hardwrap.js')}}"></script>

	<!-- Selection Dependencies --> 

	<script src="{{asset('libs/selection/mark-selection.js')}}"></script>
	<script src="{{asset('libs/selection/active-line.js')}}"></script>


	<!-- AutoComplete Dependencies --> 

	<script src="{{asset('libs/hint/show-hint.js')}}"></script>

	<script src="{{asset('libs/hint/javascript-hint.js')}}"></script>

	<script src="{{asset('libs/hint/css-hint.js')}}"></script>

	<script src="{{asset('libs/hint/html-hint.js')}}"></script>

	<script src="{{asset('libs/hint/xml-hint.js')}}"></script>

	<!-- Code Folding Dependencies -->
	<script src="{{asset('libs/fold/foldcode.js')}}"></script> 
	<script src="{{asset('libs/fold/foldgutter.js')}}"></script>
	<script src="{{asset('libs/fold/brace-fold.js')}}"></script>
	<script src="{{asset('libs/fold/comment-fold.js')}}"></script>

	<!-- Scrolling -->
	<script src="{{asset('libs/scrolls/simplescrollbars.js')}}"></script>


		<script src="{{asset('libs/search/search.js')}}"></script>
	<script src="{{asset('libs/search/searchcursor.js')}}"></script>
	<script src="{{asset('libs/search/matchesonscrollbar.js')}}"></script>
	<script src="{{asset('libs/search/jump-to-line.js')}}"></script>
	<script src="{{asset('libs/search/dialog.js')}}"></script>
	<script src="{{asset('libs/search/annotatescrollbar.js')}}"></script>

	<!-- Analysis -->
	<script src="{{asset('libs/analysis/tern.js')}}"></script>

	<!-- Save code --> 
	<script src="{{asset('js/libs/savecode.js')}}"></script>

	<!-- Custom Script -->
	<script>
		
		var skitchTitle = 'test';
	</script>
	
	<script type="text/javascript" src="{{asset('js/code.js')}}"></script>

	@include('includes.scripts.saveScript')

	

	
		<script>

	</script>

</body>
</html>