

var splitter = $('#editorContainer').height(1000).split({
	orientation : 'horizontal',
	limit : 0,
	position : '50%'

});




$('#editorPlay').height(500).split({


	orientation : 'vertical',
	limit : 10,
	postion : '20%',
	onDrag : function(event) {
        

        widthHtml = document.querySelector('#editor1 .CodeMirror').offsetWidth ; 

        widthCss = document.querySelector('#editor2 .CodeMirror').offsetWidth ; 
        widthJs = document.querySelector('#editor3 .CodeMirror').offsetWidth ; 


        

        if(widthHtml < 150){

        	$('#editor1 .editor-title').fadeOut();
        }else{

        	$('#editor1 .editor-title').fadeIn();

        }

        if(widthCss < 150){
 			$('#editor2 .editor-title').fadeOut();
        }else{

        	$('#editor2 .editor-title').fadeIn();

        }

        if(widthJs < 150){
        	 	$('#editor3 .editor-title').fadeOut();
        }else{

        	$('#editor3 .editor-title').fadeIn();

        }

      
       
    }
	
	
});

$('#design-editors').height(500).split({


	orientation : 'vertical',
	limit : 10,
	postion : '50%',
	
	onDrag : function(event) {
        
        widthHtml = document.querySelector('#editor1 .CodeMirror').offsetWidth ; 

        widthCss = document.querySelector('#editor2 .CodeMirror').offsetWidth ; 
        widthJs = document.querySelector('#editor3 .CodeMirror').offsetWidth ; 


        

        if(widthHtml < 150){

        	$('#editor1 .editor-title').fadeOut();
        }else{

        	$('#editor1 .editor-title').fadeIn();

        }

        if(widthCss < 150){
 			$('#editor2 .editor-title').fadeOut();
        }else{

        	$('#editor2 .editor-title').fadeIn();

        }

        if(widthJs < 150){
        	 	$('#editor3 .editor-title').fadeOut();
        }else{

        	$('#editor3 .editor-title').fadeIn();

        }
    }
});





//fix styles issues 

//get he design editores section amd kes its height 100% 

document.querySelector('#design-editors').style.height = '100%' ; 




var config = {

	themeHtml  : 'material',

	themeCss : 'monokai',
	themeJs : 'dracula'
}; 


//AutoComplete Code 


var htmlEditor = CodeMirror.fromTextArea(document.querySelector('#htmlEditor'),{


	mode : 'text/html',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeHtml,
	profile : 'xml',
	fullScreen : false,
	autoCloseTags : true,
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

				cm.setOption('fullScreen',true);
				$('.vsplitter').hide();
				$('.hsplitter').hide();
			}else { 

				cm.setOption('fullScreen',false);
				$('.hsplitter').show();
				$('.vsplitter').show();
			}

		},
		'Alt-F' : 'FindPersistent',
		'Esc' : function(cm){


			if(cm.getOption('fullScreen')){
				cm.setOption('fullScreen',false);
				$('.vsplitter').show();
				$('.hsplitter').show();
				}
			},
		'Ctrl-J' : "toMatchingTag",
		'Ctrl-Space' : function(cm){
              cm.showHint({hint : CodeMirror.hint.html});
		},
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		}  
		}
	

});

emmetCodeMirror(htmlEditor);


var cssEditor = CodeMirror.fromTextArea(document.querySelector('#cssEditor'),{


	mode : 'css',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeCss,
	fullScreen : false,
	autoCloseBrackets : true ,

	lint : true, 
	styleActiveLine : true,
	scrollbarStyle: 'overlay',
	styleSelectedText : true,
	foldGutter : true,
	gutters : ["CodeMirror-lint-markers","CodeMirror-linenumbers","CodeMirror-foldgutter"],
	extraKeys : {
	

		'F11' : function(cm){

			if(!cm.getOption('fullScreen')){

				cm.setOption('fullScreen',true);
				$('.vsplitter').hide();
				$('.hsplitter').hide();
			}else { 

				cm.setOption('fullScreen',false);
				$('.vsplitter').show();
				$('.hsplitter').show();
			}

		},
		'Alt-F' : 'FindPersistent',
		'Esc' : function(cm){


			if(cm.getOption('fullScreen')){
				cm.setOption('fullScreen',false);
				$('.vsplitter').show();
				$('.hsplitter').show();
			}

		},

		 'Ctrl-Space' : 'autoComplete',
		
		
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		} 
	}
	
});


 

  

var jsEditor = CodeMirror.fromTextArea(document.querySelector('#jsEditor'),{


	mode : 'javascript',
	lineNumbers : true,
	lineWrapping : true,
	theme : config.themeJs ,
	fullScreen : false,
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

				cm.setOption('fullScreen',true);
				$('.vsplitter').hide(); 
				$('.hsplitter').hide();
			}else { 

				cm.setOption('fullScreen',false);
				$('.vsplitter').show();
				$('.hsplitter').show();
			}

		},
		'Alt-F' : 'FindPersistent',
		'Esc' : function(cm){


			if(cm.getOption('fullScreen')){
				cm.setOption('fullScreen',false);
				$('.vsplitter').show();
				$('.hsplitter').show();
			}

		},
		"Ctrl-Space" : "autocomplete",
		"Shift-Space" : function(cm){

			cm.showHint({hint : CodeMirror.hint.anyword})
		} 
	}
});



/*Split(['#editor1','#editor2']);*/


function enjectCode(html,css,js,target){

	template = `
				<html>

				<head>
				   <meta charset="utf-8"/>
				   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"/>

				   <style>
				   			${css}
				   </style>
				</head>

				<body>

					${html}

					<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
					<script>
							
						${js}
					</script>
				</body>

				</html>


			`;
/*

			target.contentDocument.documentElement.innerHTML = template ; 



			//evaluate the java script code 

			var win = target.contentWindow ; 

			var scripts = target.contentDocument.scripts[1];


			try {
				win.eval(scripts.innerHTML);

			}catch(err){

				target.contentDocument.documentElement.innerHTML = err.message ; 


			}
		*/	

}

function buildTemplate(html,css,js){


	return `<html>

				<head>
				   <meta charset="utf-8"/>
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
				   <style>
				   			${css}
				   </style>
				</head>

				<body>

					${html}

				<script
				  src="https://code.jquery.com/jquery-3.3.1.min.js"
				  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
				  crossorigin="anonymous"></script>
									<script>
							
						${js}
					</script>
				</body>

				</html>`;
}

function runCode(){



	var html = htmlEditor.getValue(); 


	var css = cssEditor.getValue();

	var js = jsEditor.getValue();

	var template = buildTemplate(html,css,js);


	//var target = document.querySelector('#target');


	//Get The Preview Element 

	var previewFrame = document.getElementById('target');

	//Get The document of the iframe 

	var preview  = previewFrame.contentWindow ? previewFrame.contentWindow : previewFrame.contentDocument.document ? previewFrame.contentDocument.document : previewFrame.contentDocument;

	//open the document 

	preview.document.open();


	//inject the code Template 
	preview.document.write(template); 

	

	//close the document 
	preview.document.close();





	 //enjectCode(html,css,js,target); 


}





/* The Run Button Functionality */ 

var runButton = document.querySelector('#btnRun');


runButton.addEventListener('click',runCode); 



//Get Instance of reset Button 

var resetButton = document.querySelector('#resetBtn');


//Reset Environment Function 

function reset(){


	//empty the html editor 

	htmlEditor.getDoc().setValue('');


	//empty the css editor

	cssEditor.getDoc().setValue(''); 

	//empty the js Editor 


	jsEditor.getDoc().setValue('');


	//empty the frame 

	target.contentDocument.documentElement.innerHTML = ''; 
}



//attach event listener to the reset button 
if(resetButton)
{
	resetButton.addEventListener('click',reset);	
}


//AutoUpdate Choice Handling 

//choice checkbox handler 


//handle event 
var syncRun = _.debounce(runCode,1000);

$('#runChoice').change(function(){

	if(this.checked){
		/*Automatically Run The Code while Typing */ 

		htmlEditor.on('change',syncRun);
		cssEditor.on('change',syncRun);
		jsEditor.on('change',syncRun);

	}else {
		
		htmlEditor.off('change',syncRun);
		cssEditor.off('change',syncRun);
		jsEditor.off('change',syncRun);
	}
});

//Refresh Page functionality 

//get handler of the refresh button 

var refreshBtn = document.querySelector('#refreshBtn');
//attach event to the refresh button click 
if(refreshBtn){
refreshBtn.addEventListener('click',function(){

	location.reload();

})
};



//Settings modal 


function selectTheme(editor,type){
	var themePicker = document.getElementById('theme-picker-'+type);

	var theme = themePicker.options[themePicker.selectedIndex].textContent;
    editor.setOption("theme", theme);

}

var htmlSettingsButton = document.querySelector('#htmlSettings .settings-save-btn');

var cssSettingsButton = document.querySelector('#cssSettings .settings-save-btn');

var jsSettingsButton = document.querySelector('#jsSettings .settings-save-btn');

if(htmlSettingsButton){
htmlSettingsButton.addEventListener('click',function(){


	selectTheme(htmlEditor,'html');

	$('.modal').modal('hide');

});
}

if(cssSettingsButton){
cssSettingsButton.addEventListener('click',function(){


	selectTheme(cssEditor,'css');

	$('.modal').modal('hide');

});
}

if(jsSettingsButton){
jsSettingsButton.addEventListener('click',function(){


	selectTheme(jsEditor,'js');

	$('.modal').modal('hide');

});
}

function convertToSlug(text){


	return text.toLowerCase()
			.replace(/\s/g,'-')
			;
}
const downloadButton = document.querySelector('#download-button');


downloadButton.addEventListener('click',function(e){


	

	var html = htmlEditor.getValue();

	var css = cssEditor.getValue();

	var js = jsEditor.getValue();


	var code = `
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>${skitchTitle}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
				  
	<style>
	  ${css}
	</style>
</head>
<body>
	${html}

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		   crossorigin="anonymous"></script>
	<script>
	  ${js}
	</script>
</body>
</html>` ; 

var blob = new Blob([code],{type:"text/plain;varcharest=utf-8"});


var fileName = convertToSlug(skitchTitle) +'.html'; 

saveAs(blob,fileName);

});


//code to authorize 
if(! window.App.authorized){

	htmlEditor.setOption('readOnly','nocursor');
	cssEditor.setOption('readOnly','nocursor');
	jsEditor.setOption('readOnly','nocursor');

	const titleInput = document.querySelector('#title');

	titleInput.setAttribute('readonly', true);
	const descriptionInput = document.querySelector('#description');

	descriptionInput.setAttribute('readOnly', true);
}



 




