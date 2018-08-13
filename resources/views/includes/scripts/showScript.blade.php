<script>




/*

	filter html attribute of the code object returened from the server */ 

function extractHTML(mode){


	var txt = document.createElement('textarea');

	txt.innerHTML = '{{json_encode(json_decode($skitch->code)->html)}}' ;


	pureHTML = txt.value.slice(1,txt.value.length-1); 


	return pureHTML ; 


}



function extractCSS(){


	var txt = document.createElement('textarea'); 

	txt.innerHTML = '{{json_encode(json_decode($skitch->code)->css)}}' ; 


	pureCSS = txt.value.slice(1,txt.value.length-1) ; 

	return pureCSS ; 

}

function extractJS(){


	var txt = document.createElement('textarea'); 

	txt.innerHTML = '{{json_encode(json_decode($skitch->code)->js)}}' ; 


	pureJS = txt.value.slice(1,txt.value.length-1) ; 

	return pureJS ; 

}





htmlEditor.getDoc().setValue(extractHTML());	 

cssEditor.getDoc().setValue(extractCSS()); 


jsEditor.getDoc().setValue(extractJS()); 


</script>


