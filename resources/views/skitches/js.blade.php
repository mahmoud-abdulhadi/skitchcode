<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$skitch->title}}</title>
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
	<style>
		body {
			height : 100%;
		}
		textarea {
			width : 100%;
	
 			 height: 100vw;
		}
		
		.CodeMirror {

			width : 100%;
			height : 100%;
		}
	</style>
</head>
<body>
	<textarea name="code" id="jsEditor"></textarea>
</body>

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
	


	
<script>
	
	var js = <?= json_encode(json_decode($skitch->code)->js) ?> ; 


	var codeArea = document.querySelector('#jsEditor');

	//js = js.slice(1,js.length-1); 

	codeArea.innerHTML = js;


var jsEditor = CodeMirror.fromTextArea(document.querySelector('#jsEditor'),{


	mode : 'javascript',
	lineNumbers : true,
	lineWrapping : true,
	theme : 'dracula' ,
	fullScreen : true,
	autoCloseBrackets : true,
	foldGutter : true,
	gutters : ["CodeMirror-lint-markers","CodeMirror-linenumbers","CodeMirror-foldgutter"],
	lint : true,
	
	styleActiveLine:true,
	scrollbarStyle : 'overlay',
	extraKeys : { 
		'Qtrl-Q' : function(cm){cm.foldCode(cm.getCursor());} ,

		'F11' : function(cm){

			if(!cm.getOption('fullScreen')){

				cm.setOption('fullScreen',true), 
				$('.hsplitter').hide();
			}else { 

				cm.setOption('fullScreen',false);
				$('.hsplitter').show();
			}

		},
		'Esc' : function(cm){


			if(cm.getOption('fullScreen')){
				cm.setOption('fullScreen',false);
				$('.hsplitter').show();
			}

		},
		"Ctrl-Space" : "autocomplete",
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		} 
	}
});

</script>
</html>