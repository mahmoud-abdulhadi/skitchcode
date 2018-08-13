<script>
	


function saveCode(){

	var $form = document.querySelector('#save-form');

	var code = {


		html : htmlEditor.getValue(),

		css : cssEditor.getValue(),

		js : jsEditor.getValue()
	} 


	//create Input Hidden 
 	var code_input = document.createElement('input');

 	code_input.setAttribute('type','hidden');

 	code_input.setAttribute('name','code');

 	code_input.setAttribute('value',JSON.stringify(code));
	//add it ot the form 
	$form.appendChild(code_input);

	//submit the form 

	
	$form.submit();



}

//var saveBtn = document.querySelector('#saveBtn');

$('#saveBtn').on('click',function(e){



	$('#saveSkitch').modal();

});

$('#save-skitch-button').on('click',function(e){

	e.preventDefault();

	var title = $('#title');

	if(! title.val() ){
		var errorMessage = document.createElement('span');

		errorMessage.classList.add('text-danger');

		errorMessage.textContent = '* Title is required'; 

		var title = document.querySelector('#title');

		var parent = title.parentNode ;

		itemsLength = parent.children.length ;  
		if(parent.children[itemsLength-1].tagName == 'SPAN'){

				parent.replaceChild(errorMessage,parent.children[itemsLength-1]);
		}else { 

				parent.append(errorMessage);
		}
		
		return ; 
	}
	saveCode();
});

$('#cancel-save-button').on('click',function(e){


	e.preventDefault();

	$('#save-skitch').modal('hide');
})
</script>