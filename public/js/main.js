//build The Editor and configure them 
var htmlEditor = document.getElementById('htmlEditor'); 



var htmlCode = CodeMirror(htmlEditor,{

	mode : 'text/html',
	lineNumbers : true,
	tabSize: 2,
	value : '<!-- HTML Code Here -->',
	theme:'monokai',
	styleActiveLine : true ,
	extraKeys : {"Ctrl-Space" : "autocomplete"},
	lineWrapping : true  
}); 


var cssEditor = document.getElementById('cssEditor'); 

var cssCode = CodeMirror(cssEditor,{
	value : 'body : {margin :0px}',
	mode : 'css',
	lineNumbers : true,
	tabSize : 2,
	value: '/*CSS Code*/',
	theme: 'monokai',
	styleActiveLine : true,
	extraKeys : {"Ctrl-Space" : "autocomplete"}
});

var jsEditor = document.getElementById('jsEditor'); 


var jsCode = CodeMirror(jsEditor,{

	mode : 'javascript',
	lineNumbers : true,
	tabSize:2,
	theme:'monokai',
	value : '/*JavaScript*/',
	styleActiveLine : true,
	extraKeys : {"Ctrl-Space" : "autocomplete"} 
});


var $output = document.getElementById('output') ; 
var template ; 

function runCode(){
		   $('#html_input').attr('value', htmlCode.getValue());
		   $('#css_input').attr('value',cssCode.getValue());

		   $('#js_input').attr('value',jsCode.getValue());
			// jQuery, bind an event handler or use some other way to trigger ajax call.
			$('#html_code').submit();
}

var runButton = document.getElementById('runButton');

runButton.addEventListener('click',runCode); 
