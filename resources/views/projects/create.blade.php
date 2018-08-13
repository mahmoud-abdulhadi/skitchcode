<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="csrf-token" content="{{csrf_token()}}">

	<title>Create Prject</title>
	
	<link rel="stylesheet" type="text/css" href="/fonts_libs/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset('css/libs/codemirror.css')}}">
	<link rel="stylesheet" href="{{asset('css/theme/monokai.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/theme/material.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/theme/dracula.css')}}">

	<link rel="stylesheet" href="{{asset('libs/fullscreen/fullscreen.css')}}">
	<link rel="stylesheet" href="{{asset('libs/hint/show-hint.css')}}">
	<link rel="stylesheet" href="{{asset('libs/lint/lint.css')}}">
	<link rel="stylesheet" href="{{asset('libs/fold/foldgutter.css')}}">
	<link rel="stylesheet" href="{{asset('libs/scrolls/simplescrollbars.css')}}">

	<link href="{{asset('libs/split/jquery.splitter.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" href="{{asset('libs/tree/file-explore.css')}}">
	
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" href="{{asset('css/project.css')}}">
	<style>
		
		

		#project-header{

			height: 80px;
			padding-top: 10px;
		}

	</style>
	<script>
	window.App = {!!
          json_encode([
            'csrfToken' => csrf_token(),
            'authorized' => Auth::check(),
           
            ])

        !!};
       </script>
</head>
<body>
	<!-- Modal to confirm delete changed file -->
<div class="modal fade show confirm" id="deleteChanged" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <h2>Are you sure you want to close This File?</h2>
        <p>This file has unsaved changes which you will lose if you close the file.</p>
        <button class="btn cancel-button mr-3" data-dismiss="modal">Cancel</button>
        <button class="btn close-file" >Close File</button>
        <button class="btn save-changes">Save &amp; Close File</button>
      </div>
      
    </div>
  </div>
</div>
<div class="modal fade show save" id="saveWorkspace" tabindex="-1" role="dialog" aria-labelledby="Delete Skitch">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">

			      	<h4><span class="fa fa-cogs"></span> Workspace Settings</h4>
			      	<button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>
			      <div class="modal-body">
			       	<form id="save-form" action="{{route('workspace.store')}}" method="post">
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
							<button  class="btn btn-success" id="save-workspace-button">Save</button>
							<button class="btn btn-default" data-dismiss="modal" id="cancel-save-button">Cancel</button>
						</div>

			       	</form>
			      
			        
			      </div>
			      
			    </div>
			  </div>
	</div>



<div class="container-fluid" >
	<div class="row" id="project-header">
		<div class="col-sm-4 " >
			<div class="row">
				<div class="col-sm-12">
				<h3>Untitled</h3>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-sm-offset-2">
				
					<button id="save-button" class="btn control-button"><span class="fa fa-cloud"></span> Save</button>
					
				

			
		</div>
	</div>
	<div id="main-content">
	<div class="row" id="work-area" >
		<div id="project-tree">
			
				<div id="folde-tree">
				<h4><span class="fa fa-folder"></span> Project Root</h4>
				
				<ul id="file-tree" class="file-list">
				
				
					
				</ul>
	
				<div class="new-items">
					<button class="btn btn-dark" id="create-folder-root"><span class="fa fa-folder"></span> <span class="fa fa-plus"></span></button>
					<button class="btn btn-dark" id="create-file-root"><span class="fa fa-file"></span> <span class="fa fa-plus"></span></button>
				</div>
			
				</div>
		
			
			
		</div>
		<div >
			<ul class="file-tabs">

			
		</ul>


			<textarea  id="editor" class="editor"></textarea>
		</div>
	</div>
	
	</div>
</div>

	



<script src="{{asset('js/app.js')}}"></script>


<script src="{{asset('js/libs/codemirror.js')}}"></script>
<script src="{{asset('js/xml/xml.js')}}"></script>
<script src="{{asset('js/css/css.js')}}"></script>
<script src="{{asset('js/libs/emmet.js')}}"></script>
<script src="{{asset('js/javascript/javascript.js')}}"></script>
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
<script src="{{asset('js/projects/code.js')}}"></script>



<script>

	

	

	function copyChanges(items,tab){


		for(var i = 0 ; i < items.length;i++)
		{


			if(items[i].name == tab.name){
				items[i].content = tab.content ; 

				return ; 

			}	

			if(items[i].isFolder){

				copyChanges(items[i].children,tab);
			}
		}
	}

	function copyAllChanges(tabs){

		for(var i = 0 ; i < tabs.length;i++){

			if(tabs[i].changed){

				copyChanges(pureItems,tabs[i]);
			}
		}
	}

	function axiosSaveWorkspace(){

			copyAllChanges(tabs);
			{{--var url = '/workspaces/{{$workspace->author->username}}/{{$workspace->id}}';--}}

			axios.put(url,{

				items : JSON.stringify(pureItems)
			})
			.then(function(response){


				//save data 
				 pureItems = response.data ; 


				//remove change indicators 

				for(var i = 0; i < tabs.length;i++){

					tabs[i].changed = false ; 
				}

				//render tabs 

				renderTabs(tabs);

				//render tree 
				buildTree(pureItems,rootNode);

				


				alertify.logPosition('top right');

				alertify.success("Workspace has been Updated!");




			});
			
	}

	function saveWorkspace(){

		var $form = document.querySelector('#save-form');

		copyAllChanges(tabs);

		var codes_input = document.createElement('input');

		codes_input.setAttribute('type','hidden');

		codes_input.setAttribute('name','items');

		var items = JSON.stringify(pureItems);

		codes_input.setAttribute('value',items);

		codes_input.id = 'items';

		$form.appendChild(codes_input);

		

	    $form.submit();

	}

	$('#cancel-save-button').on('click',function(e){

		e.preventDefault();

		$('#saveWorkspace').modal('hide');



	})

	$('#save-button').on('click',function(e){
		e.preventDefault();

		$('#saveWorkspace').modal();

	});

	$('#save-workspace-button').on('click',function(e){

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
		saveWorkspace();

	});

	var closeFile = document.querySelector('.close-file');

	closeFile.addEventListener('click',function(){

		var name = document.querySelector('.active .file-tab-contents .file-tab-name').innerHTML ; 

		deleteTab(tabs,name);



		$('#deleteChanged').modal('hide');

		var index = getIndexTab(tabs,name);
		deleteTab(tabs,name);

			if(index > 0){

						

					var extension = extractExt(tabs[index-1].name); 


							for(var i =0;i< tabs.length ;i++){
								if(i != index - 1){

									tabs[i].active = false;

								}
							}

							tabs[index-1].active = true ; 
							
							if(extension == 'html'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),htmlConfig);
									emmetCodeMirror(editor);

									editorAttachEvent(editor);

							}else if(extension == 'css'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),cssConfig);
									editorAttachEvent(editor);
							}else if(extension == 'js'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),jsConfig);

									editorAttachEvent(editor);
							}

							editor.setValue(tabs[index-1].content);



			
					
					}else {

						editor.setValue('');
					}
					renderTabs(tabs);


	});


	$('.save-changes').on('click',function(e){

		e.preventDefault();

		saveWorkspace();

	});

	function loadItems(){

		//var txt = document.createElement('textarea');

		

		

		var items = [] ; 
		
		

		return items ; 
		

	}


	function deleteTab(tabs,name){

		for(var i = 0 ; i<tabs.length;i++){

			if(tabs[i].name == name){

				tabs.splice(i, 1);
			}
		}
	}

	function getIndexTab(tabs,name){

		for(var i =0;i<tabs.length;i++){

			if(tabs[i].name == name){

				return i ; 
			}
		}
		return -1 ; 
	}

	function findActive(tabs){

		for(var i = 0 ; i < tabs.length;i++){

			if (tabs[i].active == true) 
				return tabs[i];
		}

		return null ; 
	}

	function renderTabs(tabs){

		var fileTabs = document.querySelector('.file-tabs');

		fileTabs.innerHTML = '' ; 

		for(var i=0;i<tabs.length;i++){

			//create new node Element 
			/*
			<li class="file-tab active"><div class="file-tab-contents file-html"><span class="file-tab-name">index.html</span><span class="fa fa-times close-button"></span></div></li> */

			var tab = document.createElement('li');

			tab.classList.add('file-tab');

			if(tabs[i].active){
				tab.classList.add('active');
			}


			var divTab = document.createElement('div');

			divTab.classList.add('file-tab-contents');

			//get extension 

			extension = extractExt(tabs[i].name);

			if(extension == 'html'){


				divTab.classList.add('file-html') ;
			}else if(extension == 'css'){

				divTab.classList.add('file-css') ;

			}else if(extension == 'js'){

				divTab.classList.add('file-js') ;
			}



			var fileNameSpan = document.createElement('span');

			var fileName = document.createTextNode(tabs[i].name);

			fileNameSpan.append(fileName);

			fileNameSpan.classList.add('file-tab-name');

			var spanElement = document.createElement('span');

			if(!tabs[i].changed)
			{
				spanElement.classList.add('fa');
				spanElement.classList.add('fa-times');
				spanElement.classList.add('close-button');

			}else { 

				spanElement.classList.add('change-indicator');

			}
			

			
			

			

			divTab.append(fileNameSpan);

			divTab.append(spanElement);

			spanElement.addEventListener('click',function(e){

					var name = e.target.previousSibling.innerHTML;
					
					var tab = findTabByName(tabs,name);

					//console.log(tab);
					
					if(tab.changed){

						$('#deleteChanged').modal();
					}else {
						
						var index = getIndexTab(tabs,name);
						deleteTab(tabs,name);

						if(index > 0){

						

							var extension = extractExt(tabs[index-1].name); 


							for(var i =0;i< tabs.length ;i++){
								if(i != index - 1){

									tabs[i].active = false;

								}
							}

							tabs[index-1].active = true ; 
							
							if(extension == 'html'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),htmlConfig);
									emmetCodeMirror(editor);

									editorAttachEvent(editor);

							}else if(extension == 'css'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),cssConfig);
									editorAttachEvent(editor);
							}else if(extension == 'js'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),jsConfig);

									editorAttachEvent(editor);
							}

							editor.setValue(tabs[index-1].content);



			
					
					}else {

						editor.setValue('');
					}
					renderTabs(tabs);

				}	

			});

			tab.append(divTab);

			fileTabs.append(tab);

			fileNameSpan.addEventListener('click',function(e){

				var name = e.target.innerHTML ; 

				var tabFound = findTabByName(tabs,name);

				tabFound.active = true ; 

				for(var i = 0 ; i < tabs.length;i++){

					if(tabs[i].name != tabFound.name){

						tabs[i].active = false ; 
					}
				}

				var extension = extractExt(name);

				if(extension == 'html'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),htmlConfig);
									emmetCodeMirror(editor);

									editorAttachEvent(editor);

					}else if(extension == 'css'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),cssConfig);

									editorAttachEvent(editor);

				}else if(extension == 'js'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),jsConfig);
									editorAttachEvent(editor);

				}


				
				

				editor.setValue(tabFound.content);

				

				renderTabs(tabs);				

			});
		}


	}




	function getObject(items,id,callback){

		for(var i = 0 ; i < items.length;i++){

			if(items[i].name == id){

				callback(items[i]);

				
			}

			if(items[i].isFolder){


				getObject(items[i].children,id,callback);
			}
		}
	}

	//version of get Object to delete item 

	function deleteItem(items,id){

		for(var i =0 ; i < items.length;i++){

				if(items[i].name == id){

					items.splice(i,1);
			
					return ; 

				}

				if(items[i].isFolder){

					deleteItem(items[i].children,id);
				}

		} 

	}



	// function to return tab object by name 
	function findTabByName(tabs,name){

		for(var i = 0 ; i < tabs.length ; i++){

			if(tabs[i].name == name){

				return tabs[i] ; 
			}

			
		}
	return null ; 
}
	//function to extract extension 

	function extractExt(filename){

		var dotIndex = filename.lastIndexOf('.');

		ext = filename.slice(dotIndex+1,);


		return ext ; 

	}

	//function to get a tab and apply call back to it 

	function getActiveTab(tabs,callback){


		for(var i = 0 ; i < tabs.length;i++){

			if (tabs[i].active){

				callback(tabs[i]);
			}
		}
	}


	function buildTree(items,node,collapsed=true){
		node.innerHTML = '';
		if(items.length > 0){

			for(var i = 0;i<items.length;i++){

				var liNode = document.createElement('li');
				var aNode = document.createElement('a');
				var textNode = document.createTextNode(items[i].name);

				aNode.appendChild(textNode);

				liNode.id = items[i].name;

				liNode.appendChild(aNode);

				//append Edit Icon 

				var editIcon = document.createElement('span');

				editIcon.classList.add('fa');
				editIcon.classList.add('fa-edit');
				editIcon.classList.add('edit-command');

				editIcon.classList.add('command');

				editIcon.setAttribute('title','Rename');

				editIcon.id = items[i].name ; 

				liNode.appendChild(editIcon);

				editIcon.addEventListener('click',function(){

					
					var editInput = document.createElement('INPUT');

					editInput.setAttribute('type','text');

					editInput.setAttribute('value',this.parentElement.children[0].textContent);

					;

					editInput.classList.add('command-input');


					var firstChild = this.parentElement.children[0];


					this.parentElement.replaceChild(editInput,firstChild);

					editInput.focus();

					editInput.addEventListener('keyup',function(e){

						if(e.keyCode == 13){



						id = e.target.parentElement.children[1].id ; 


						isFolder = e.target.parentElement.classList.contains('folder-root');

						if( isFolder){

							type = 'folder' ; 
						}else{

							type = 'file' ; 
						}

						var result = validate(e.target.parentElement.children[0].value,type);

						if(! result.status){

							alertify.logPosition('top right');
							alertify.error(result.message);

						}else{

							getObject(pureItems,id,function(target){

							//get the text value 

							var newValue = e.target.parentElement.children[0].value ; 

							//assign it to target 
							target.name = newValue ; 
							//get the root node 

							
							//build the tree again 
							buildTree(pureItems,rootNode);


						});

					}


						
					}

				});

				editInput.addEventListener('focusout',function(){

				buildTree(pureItems,rootNode);
				});


						
			});

				var deleteIcon = document.createElement('span');


				deleteIcon.classList.add('fa');
				deleteIcon.classList.add('fa-trash');

				deleteIcon.classList.add('command');

				deleteIcon.setAttribute('title','Remove');




				liNode.append(deleteIcon);

				deleteIcon.addEventListener('click',function(e){


					var id = e.target.parentElement.children[1].id; 

					alertify.confirm("Are you sure you want to delete This component?", function (ev) {

						    ev.preventDefault();

						   

						    deleteItem(pureItems,id);

							buildTree(pureItems,rootNode);

							 alertify.alert("Component Deleted Successfully!!");


						}, function(ev) {

						    // The click event is in the
						    // event variable, so you can use
						    // it here.
						    ev.preventDefault();

						    alertify.alert("Deletion Cancelled");

						});

					

				});

			

				node.append(liNode);


				aNode.addEventListener('click',function(e){
						//if item is folder
						if(this.parentElement.classList.contains('folder-root')){

							if(this.parentElement.classList.contains('closed')){
								this.parentElement.classList.remove('closed');
								this.parentElement.classList.add('open');
							}else{

							this.parentElement.classList.remove('open');
							this.parentElement.classList.add('closed');
						}
					}  // if it is file display content
						else {
							//edit icon id 
							//TODO modify 
							var id = e.target.nextSibling.id;
						
							getObject(pureItems,id,function(target){

								var extension = extractExt(target.name);

								var tabFound = findTabByName(tabs,target.name) ;

								if(!tabFound){
									//create new Tab 
									var newTab = {

										name : target.name , 
										changed:false,
										content : target.content,
										active: true
									}

								 	tabs.push(newTab);

									 for(var i = 0 ; i < tabs.length-1;i++){

									 	tabs[i].active = false;
									 }
								 
								}else{


									tabFound.active = true ;

									for(var i =0;i<tabs.length;i++){

										if(tabs[i].name != tabFound.name){

											tabs[i].active = false;
										}
									}
								}

								renderTabs(tabs);

								if(extension == 'html'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),htmlConfig);

									emmetCodeMirror(editor);

									editorAttachEvent(editor);

								}else if(extension == 'css'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),cssConfig);
									editorAttachEvent(editor);

								}else if(extension == 'js'){

									editor = CodeMirror.fromTextArea(document.querySelector('#editor'),jsConfig);
									editorAttachEvent(editor);
								}	

								editor.setValue(target.content);
								

							});
						}
						

					});

				if(items[i].isFolder){

					liNode.classList.add('folder-root');

					if(collapsed)
						liNode.classList.add('closed');
					else 
						liNode.classList.add('open');

					//Add New Folder 

					//create span element for the icon 

					var newFolderIcon = document.createElement('span');

					newFolderIcon.classList.add('fa');

					newFolderIcon.classList.add('fa-plus-circle');


					newFolderIcon.title = "New Folder";

					newFolderIcon.classList.add('command');

					newFolderIcon.id = "folder-" + items[i].name;

					//create new Folder Event Handler 

					newFolderIcon.addEventListener('click',function(item){


						//open the folder 

						this.parentElement.classList.remove('closed');

						this.parentElement.classList.add('open');

						//create textbox and append it 

						var newFolderInput = document.createElement('INPUT');
						newFolderInput.setAttribute('type', 'text');

						newFolderInput.setAttribute('placeholder', 'New Folder Name');
						newFolderInput.classList.add('command-input');

						

						//get the last child '<ul>'
						var lastChildIndex = this.parentElement.children.length - 1 ; 

						//get the last child 

						var lastChild = this.parentElement.children[lastChildIndex];

						//if last child is input replace last child 
						var append = false; 

						tagName = lastChild.tagName.toLowerCase();
						if(tagName != 'input'){

							append = true ; 

						}


						//else append it 

						if(append){

								this.parentElement.children[lastChildIndex].appendChild(newFolderInput);
						}else {

								//get the last child [input text]
								var lastInputChildIndex = this.parentElement.children[lastChildIndex].children.length - 1;
								var lastInputChild = this.parentElement.children[lastChildIndex].children[lastInputChildIndex];

								//replace last child with the new text 

								this.parentElement.child[lastChildIndex].replace(newFolderInput,lastInputChild);
						}

						

						//set the autofocus
						newFolderInput.focus();

						newFolderInput.addEventListener('keyup', function(e){

								if(e.keyCode == 13){


									

									//var newFolder = document.createElement('li');

									//var newFolderName = document.createTextNode(this.value);


									//newFolder.append(newFolderName);


									//add folder to the data 

									//get Id 

									var id = this.parentElement.parentElement.id;

									var result = validate(e.target.value,'folder');

									if(! result.status){

										alertify.logPosition('top right');

										alertify.error(result.message);
									}else{

										getObject(pureItems,id,function(target){
										var newFolderItem = {

											name : e.target.value, 
											isFolder : true, 
											children : []
										} ; 

										target.children.push(newFolderItem);

										buildTree(pureItems,rootNode,false);

									});

									//find the object and add new folder to target and build the tree

								
								}

							}
						});


						newFolderInput.addEventListener('focusout',function(){

							buildTree(pureItems,rootNode,false);
				});

			});


					//add The Add Folder Button 
					liNode.appendChild(newFolderIcon);


					var newFileIcon = document.createElement('span');

					newFileIcon.classList.add('fa');
					newFileIcon.classList.add('fa-file-o');

					newFileIcon.classList.add('command');
					newFileIcon.title = "Add New File";

					//haandling events for creating new File 


					newFileIcon.addEventListener('click',function(){

						this.parentElement.classList.remove('closed');

						this.parentElement.classList.add('open');


						var newFileInput = document.createElement('INPUT');

						newFileInput.setAttribute('type', 'text');

						newFileInput.setAttribute('placeholder', 'New File Name');
						newFileInput.classList.add('command-input');

						//get the last child '<ul>'
						var lastChildIndex = this.parentElement.children.length - 1 ; 

						//get the last child 

						var lastChild = this.parentElement.children[lastChildIndex];

						//if last child is input replace last child

						this.parentElement.children[lastChildIndex].appendChild(newFileInput);


						//when Enter is pressed on the TextBox Add NewFile 
						newFileInput.addEventListener('keyup',function(e){

							if(e.keyCode == 13){


								//var newFile = document.createElement('li');

								//	var newFileName = document.createTextNode(this.value);


								//	newFolder.append(newFolderName);


									//add folder to the data 

									//get Id 

									var id = this.parentElement.parentElement.id;

									//find the object and add new folder to target and build the tree
									var result = validate(e.target.value,'file');
									if(! result.status){
										alertify.logPosition('top right');
										alertify.error(result.message);

									}else {

										getObject(pureItems,id,function(target){
										var newFileItem = {

											name : e.target.value, 
											isFolder : false, 
											content : `<!--Code Goes here-->`
										}

										target.children.push(newFileItem);

										buildTree(pureItems,rootNode,false);

									});

								}

								
							}
						}); 

						//make the tree refresh when text lose focus
						newFileInput.addEventListener('focusout',function(){

							buildTree(pureItems,rootNode,false);

						});

						newFileInput.focus();

					});


					liNode.appendChild(newFileIcon);


									

					var ulNode = document.createElement('ul');

					liNode.appendChild(ulNode);

					buildTree(items[i].children,ulNode);

			} // if(imes[i].isFolder)
		} //for loop

		//create new Folder Command 


	} // if(item.length > 0)

} //buildTree function 

		

		function sortItems(items){


			items.sort(function(x,y){

				return (x.isFolder === y.isFolder) ? 0 : x.isFolder ? -1 : 1 ; 

			});
		}


		var createFolder = document.querySelector('#create-folder-root');
		//create New Folder to Root 
		createFolder.addEventListener('click',function(){


			//create New Text Input 
			var newFileInput = document.createElement('INPUT');

			newFileInput.setAttribute('type','text');

			newFileInput.setAttribute('placeholder', 'New Folder Name');

			newFileInput.classList.add('addItemInput');


			newFileInput.addEventListener('keyup',function(e){
					if(e.keyCode == 13){

						var result = validate(e.target.value,'folder'); 

						if(!result.status){
							alertify.logPosition('top right');

							alertify.error(result.message);

						}else{
								var newFolder = {

								name : e.target.value ,
								isFolder : true,
								children : []
							}

							pureItems.push(newFolder);

							sortItems(pureItems);

							buildTree(pureItems,rootNode);

							this.parentElement.removeChild(this);

						}
						
						
					}

			});

			newFileInput.addEventListener('focusout',function(){

				sortItems(pureItems);

				buildTree(pureItems,rootNode);

				this.parentElement.removeChild(this);


			});

			//add it to the parent of 
			this.parentElement.appendChild(newFileInput);
			//handle the create now





			newFileInput.focus();


		});

		var createFile = document.querySelector('#create-file-root');


		createFile.addEventListener('click', function(){

			//create New Text Input 
			var newFileInput = document.createElement('INPUT');

			newFileInput.setAttribute('type','text');

			newFileInput.setAttribute('placeholder', 'New File Name');

			newFileInput.classList.add('addItemInput');

			newFileInput.addEventListener('keyup',function(e){
					if(e.keyCode == 13){



						var result = validate(e.target.value,'file') ; 

						if(! result.status){

							alertify.logPosition('top right');
							alertify.error(result.message);

						}else{

							var newFile = {

							name : e.target.value ,
							isFolder : false,
							content : `<!--Code Goes Here -->`
						}
						

						pureItems.push(newFile);

						sortItems(pureItems);

						buildTree(pureItems,rootNode);

						this.parentElement.removeChild(this);
					}
				}

			});



			newFileInput.addEventListener('focusout',function(){

				sortItems(pureItems);

				buildTree(pureItems,rootNode);

				this.parentElement.removeChild(this);


			});

			//add it to the parent of 
			this.parentElement.appendChild(newFileInput);
			//handle the create now



			newFileInput.focus();


		});





		var rootNode = document.querySelector('#file-tree');
		

		var pureItems =  loadItems();


		var tabs = []; 

		//put the Folders first 

		sortItems(pureItems);


		buildTree(pureItems,rootNode);


		function editorAttachEvent(editor){

			editor.on('keyup',function(){

				getActiveTab(tabs,function(target){

					target.content = editor.getValue();
					
					target.changed = true ; 

					renderTabs(tabs);
			
				});

			});
		}



		

		function convertToChange(){

				var activeTab = document.querySelector('.active .file-tab-contents');
				var oldClose = activeTab.children[1];
				var changeIndicator = document.createElement('span');
				changeIndicator.classList.add('change-indicator');
				activeTab.replaceChild(changeIndicator, oldClose);

		}

		function convertToClose()
		{

			var activeTab = document.querySelector('.active .file-tab-contents');
				var oldSpan = activeTab.children[1];
				var newSpan = document.createElement('span');
				newSpan.classList.add('fa');
				newSpan.classList.add('fa-times');
				activeTab.replaceChild(newSpan, oldSpan);

		}


		//validation function 
		function validate(name,type){

			if(! name){
				

				return {
					message : 'Item Name Can Not be empty' , 
					status : false

				} ; 
			}
			//test agains white space
			if( /\s/g.test(name)){

				return {

					message : 'Item Name Can Not constain spaces',
					status : false
				};
			}

			//test against if there is characters other than alpha dot number underscore

			if(/[^\_\w\.]/g.test(name)){

				return {

					message : 'invalid Characters used!',
					status : false
				}
			}


			if(type == 'file'){
				//force extension 

				var pattern = new  RegExp(/[^\\/]+\.[^\\/]+$/);

				var res = pattern.test(name) ; 

				if(! res){

					return {

						message : 'Extension Needed!', 
						status: false

					}

				}
				//validate extension


				allowedExtensions = ['html','css','js','json']; 


				extension = extractExt(name);

				// not found in the allowed extension
				if(allowedExtensions.indexOf(extension) < 0){

					return {
						message : '<h5>Allowed Files</h5><ul><li>HTML Files *.html</li><li>CSS Files *.css</li><li>JavaScript Files : *.js</li><li>Json Files: *.json</li></ul>',
						status : false 


					}

				}	
			

		}

			return {

				message : 'OK',
				status : true
			}

		}




	
	
	
</script>



</body>
</html>