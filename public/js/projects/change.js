var splitter = $('#work-area').height(500).split({

	limit : 0 ,
	orientation : 'vertical',
	position : '50%'
});
	width =  window.innerWidth || document.body.clientWidth ; 

	var splitter2 = $('#main-content').height(800).width(width).split({
	limit : 60,
	orientation: 'horizontal',
	position :'50%'

});

window.addEventListener('resize', function(){



	width =  window.innerWidth || document.body.clientWidth ; 

	var splitter2 = $('#main-content').height(1000).width(width).split({
	limit : 30,
	orientation: 'horizontal',
	position :'50%'

});

	
});

var target = document.getElementById("view");
target.innerHTML = "";
var dv = CodeMirror.MergeView(target, {
    value: '',
    origLeft: null,
    orig: '',
    lineNumbers: true,
    mode: "text/html",
    highlightDifferences: true,
    showDifferences : true,
    theme : 'monokai'
  });
/*
var config = {

	themeHtml  : 'material',

	themeCss : 'monokai',
	themeJs : 'dracula'
}; 

var readOnlyConfig = true;

var htmlConfig = {
	mode : 'text/html',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeHtml,
	profile : 'xml',
	fullScreen : false,
	autoCloseTags : true,
	readOnly : readOnlyConfig , 
	autoCloseBrackets : true,
	matchTags : {bothTags : true},
	lint : true, 
	styleActiveLine : true,
	scrollbarStyle :'overlay',
	foldGutter : true,
	gutters : ['CodeMirror-lint-markers','CodeMirror-linenumbers','CodeMirror-foldgutter'],
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
		'Alt-F' : 'FindPersistent',
		'Ctrl-J' : "toMatchingTag",
		'Ctrl-Space' : function(cm){
              cm.showHint({hint : CodeMirror.hint.html});
		},
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		}  
		}

}

var cssConfig = { 

mode : 'css',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeCss,
	fullScreen : false,
	autoCloseBrackets : true ,
	readOnly : readOnlyConfig , 
	lint : true, 
	styleActiveLine : true,
	scrollbarStyle: 'overlay',
	styleSelectedText : true,
	foldGutter : true,
	gutters : ["CodeMirror-lint-markers","CodeMirror-linenumbers","CodeMirror-foldgutter"],
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
		'Ctrl-Space' : 'autocomplete' ,
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		} 
	}
}

var jsConfig = {
	mode : 'javascript',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeJs ,
	fullScreen : false,
	autoCloseBrackets : true,
	foldGutter : true,
	readOnly : readOnlyConfig,
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

}


var editor = CodeMirror.fromTextArea(document.querySelector('#editor'),htmlConfig);

*/