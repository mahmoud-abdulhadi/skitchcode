<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="csrf-token" content="{{csrf_token()}}">

	<title>{{$workspace->title}}</title>
	
	<link rel="stylesheet" type="text/css" href="/fonts_libs/font-awesome.min.css">


	<link rel="stylesheet" href="{{asset('css/libs/codemirror.css')}}">
	<link rel="stylesheet" href="{{asset('css/theme/monokai.css')}}">
	<link rel="stylesheet" href="{{asset('libs/merge/merge.css')}}">
		
	

	<link href="{{asset('libs/split/jquery.splitter.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" href="{{asset('libs/tree/file-explore.css')}}">
	
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" href="{{asset('css/project.css')}}">




     <style>
     	
     	.all-section{


          	padding-bottom : 50px;


          }

          .all-section .username{
          	width :100%;
          	float : left;
          	margin : 0 2% 2% 0;
          	white-space: nowrap;
          	padding:10px;
          	display : flex;
          	border-radius: 0px;
          	overflow:hidden;
          	background : #32333B;
          }

          .all-section a {

          	text-decoration: none;
          }

          .all-section .username:hover {

          	background : #222;
          }

          .all-section .username .avatar  {
          	width : 20px;
          	height: 20px;
          	margin :0 10px 0 0;
          	outline: 0;
          	border:0;
          	max-width: 100%;

          }

          .changes .avatar{
			width : 35px; 
			height :35px;
			outline: 0;
          	border:0;
          	max-width: 100%;

          }

          .change .changer {

          	font-weight: bold;
          	margin-left: 10px;
          	font-size: 1eml
          }

          .change {

          	background : #434366;

          	border-radius: 0px;

          	box-shadow: -3px -3px 8px #999
          }

          .change:hover {

          	background : #212144;
          }



          .all-section .username .username-text , .changes .username-text{
          	overflow:hidden;
          	text-overflow: ellipsis;

          	color : #FFF;

          }

          .details-section-header{
          	color : white;
          	font-weight: 700;
          	background : #111;
          	margin : 10px 0 5px 0;
          	padding : 20px;
          }

          .meta-count {
			font-weight: 400 ; 
			font-size: 0.8em;

          }

          #footer-panel {


          	z-index : -1000;
          }


     </style>
			
</head>
<body>

<div class="container-fluid" >
	<div class="row pt-3 pb-3">
		
		<div class="col-md-4 project-info">
			<h3 id="projectTitle">{{$workspace->title}}</h3>
			<div id="project-author">Updated By <span class="fa fa-user-circle"></span> {{$coder->name}}</div>

		</div>
		<div class="col-md-2  text-right">
			<a style="color:white" class="btn btn-dark" href="{{$workspace->path()}}"><span class="fa fa-chevron-circle-left"></span> Back To Project</a>
		</div>
		@if(Auth::check())
		<div class="col-md-2 offset-md-1 ">
		@else 
		<div class="col-md-2 offset-md-1 ">
		@endif

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
		
		
		
		@endif
	
	
		



			@if(Auth::check())
			<div class="col-md-1  text-right">
			<div class="dropdown text-right" id="avatar-dropdown">
				  <a  type="button" id="avatar-dropdown-btn"  aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
				   <img id="avatar-top" src="{{Auth()->user()->avatar}}">
				  </a>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	 <h5 class="dropdown-header">Create..</h5>
				    <a class="dropdown-item" href="/skitch"><span class="fa fa-code"></span> New Skitch</a>
				    <a class="dropdown-item" href="/workspaces/create"><span class="fa fa-file-code-o"></span> New Worksapce</a>
				    <a class="dropdown-item" href="#"><span class="fa fa-book"></span> New Post</a>
				    <a class="dropdown-item" href="#"><span class="fa fa-comments"></span> New Discussion</a>
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
		</div>
			@else
					<div class="col-md-1 offset-md-1"></div> 
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

	<div class="row" id="project-header" style="font-style:italic;font-weight:600;font-size:1.5em">
		<div class="col-sm-6">
			<p>Old Title:</p>
			<p id="oldTitle"></p>

		</div>
		
		<div class="col-sm-6">
			<p>New Title:</p>
				<p id="newTitle"></p>
		</div>
		
		
			
	</div>
	<div class="row" style="background:#333;color : #DDD;font-style:italic;font-weight: 200;font-size: 1em;">
			<div class="col-sm-6" style="border-right:2px solid #DDD">
				<p style="font-size:1.5em;font-weight:200">Old Description:</p> <p id="beforeProjectDescription"></p>

			</div>
			<div class="col-sm-6">
				<p style="font-size:1.5em;font-weight:200">New Description: </p><p id="afterProjectDescription"></p>
			</div>
		</div>
	<div id="main-content">
	<div class="row" id="work-area" >
		<div id="project-tree">
			
				<div id="folde-tree">
				<h4><span class="fa fa-folder"></span>Before Project Structre</h4>
				
				<ul id="file-tree" class="file-list">
				
				
					
				</ul>
	
				
			
				</div>
		
			
			
		</div>
		<div id="after-project-tree">
			
				<div id="after-folde-tree">
				<h4><span class="fa fa-folder"></span>After Project Structure</h4>
				
				<ul id="after-file-tree" class="file-list">
				
				
					
				</ul>
	
				
			
				</div>
		
			
			
		</div>
		
	</div>
	<div>
	<div id="view">
	
	

	</div>
	</div>
		
	
</div>

	


<script src="{{asset('js/app.js')}}"></script>


<script src="{{asset('js/libs/codemirror.js')}}"></script>
<script src="{{asset('js/xml/xml.js')}}"></script>
<script src="{{asset('js/css/css.js')}}"></script>

<script src="{{asset('js/javascript/javascript.js')}}"></script>

<script src="{{asset('libs/merge/merge.js')}}"></script>

<script src="{{asset('libs/merge/diff_match_patch.js')}}"></script>


<script src="{{asset('libs/split/jquery.splitter.js')}}"></script>





<script>
	

	function loadItems(){

		//var txt = document.createElement('textarea');
			@if(isset(json_decode($change->before)->title))
		 beforeTitle = "<?= json_decode($change->before)->title ?>" ;

		 afterTitle = "<?= json_decode($change->after)->title ?>" ; 

		 @else 

		 beforeTitle = "<?= $workspace->title ?>" ; 
		  afterTitle = "<?= $workspace->title ?>" ;

		  @endif

		 @if(isset(json_decode($change->before)->description))

		 beforeDesc = "<?= json_decode($change->before)->description ?>" ; 

		 afterDesc = "<?= json_decode($change->after)->description ?>" ; 

		 @else 
		 	 beforDesc = "<?= $workspace->description ?>" ; 
		  	afterDesc = "<?= $workspace->description ?>" ;

		 @endif



		 @if(isset(json_decode($change->before)->items))

		 beforeItems = <?= json_decode($change->before)->items ?> ;

		 afterItems =  <?= json_decode($change->after)->items ?> ;
	
		@else 

			beforeItems = "<?= $workspace->items ?>" ; 
		  	afterItems  = "<?= $workspace->items ?>" ;

		@endif
		var items = <?= $workspace->items ?> ; 
		
		

		return items ; 
		

	}

	function convertToArray(tree,vec = []){
		
		for(var i = 0 ; i < tree.length;i++){
			vec.push(tree[i]);

			if(tree[i].isFolder){

				convertToArray(tree[i].children,vec);
			}


		}
	}

	function getContentArray(items,id){

		for(var i = 0 ;i < items.length;i++){

			if(items[i].name == id){

				return items[i].content ; 
			}
		}
	}


function getContent(items,id){

	for(var i = 0 ; i < items.length ;i++){

		

		if(items[i].name == id){

			let content = items[i].content ; 



			return content ; 
		}

		if(items[i].isFolder){

			getContent(items[i].children,id);
		}
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



	//function to extract extension 

	function extractExt(filename){

		var dotIndex = filename.lastIndexOf('.');

		ext = filename.slice(dotIndex+1,);


		return ext ; 

	}

	
	function fillData(beforeTitle,afterTitle,beforeDesc,afterDesc){

		document.querySelector('#oldTitle').innerHTML = beforeTitle ; 

		document.querySelector('#newTitle').innerHTML = afterTitle ; 


		document.querySelector('#beforeProjectDescription').innerHTML = beforeDesc ; 

		document.querySelector('#afterProjectDescription').innerHTML = afterDesc ; 


	}


	function buildTree(items,node,collapsed=true,){
		node.innerHTML = '';

		if(items.length > 0){

			for(var i = 0;i<items.length;i++){

				var liNode = document.createElement('li');
				var aNode = document.createElement('a');
				var textNode = document.createTextNode(items[i].name);

				aNode.appendChild(textNode);

				liNode.id = items[i].name;

				liNode.appendChild(aNode);

			

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
							var id = e.target.textContent;

		
							
								var extension = extractExt(id);

							


								var beforeContent = getContentArray(beforeVec,id);

								console.log(beforeContent);

								var afterContent = getContentArray(afterVec,id);

								console.log(afterContent);
							
								
								
								if(extension == 'html'){



									var oldDiv  = document.querySelector('#view');

									var newDiv = document.createElement('div');

									newDiv.id = 'view';

									oldDiv.parentElement.replaceChild(newDiv,oldDiv);

									var dv = CodeMirror.MergeView(document.querySelector('#view'), {
									    value: afterContent,
									    origLeft: null,
									    orig: beforeContent,
									    lineNumbers: true,
									    mode: "text/html",
									    highlightDifferences: true,
									    showDifferences : true,
									   
									  });
								

								}else if(extension == 'css'){

									var oldDiv  = document.querySelector('#view');

									var newDiv = document.createElement('div');

									newDiv.id = 'view';

									oldDiv.parentElement.replaceChild(newDiv,oldDiv);

									var dv = CodeMirror.MergeView(document.querySelector('#view'), {
									    value: afterContent,
									    origLeft: null,
									    orig: beforeContent,
									    lineNumbers: true,
									    mode: "css",
									    highlightDifferences: true,
									    showDifferences : true,
									  
									  });




								}else if(extension == 'js'){

									var oldDiv  = document.querySelector('#view');

									var newDiv = document.createElement('div');

									newDiv.id = 'view';

									oldDiv.parentElement.replaceChild(newDiv,oldDiv);

									var dv = CodeMirror.MergeView(document.querySelector('#view'), {
									    value: afterContent,
									    origLeft: null,
									    orig: beforeContent,
									    lineNumbers: true,
									    mode: "javascript",
									    highlightDifferences: true,
									    showDifferences : true,
									   

									  });


								}	

							
								

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

				

					//create new Folder Event Handler 

									

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


	
		var createFile = document.querySelector('#create-file-root');


	




		var beforeNode = document.querySelector('#file-tree');

		var afterNode = document.querySelector('#after-file-tree');
		
		var beforeTitle ; 

		var afterTitle ; 

		var beforeDesc ; 

		var afterDesc ; 

		var beforeItems ; 

		var afterItems ; 

		var pureItems =  loadItems();


		fillData(beforeTitle,afterTitle,beforeDesc,afterDesc);



		var beforeVec = [] ; 

		var afterVec = []  ; 

		convertToArray(beforeItems,beforeVec);

		convertToArray(afterItems,afterVec);
 
		



		buildTree(beforeItems,beforeNode);

		buildTree(afterItems,afterNode);

		


		function editorAttachEvent(editor){

			editor.on('keyup',function(){

				getActiveTab(tabs,function(target){

					target.content = editor.getValue();
					

						
					
					

					renderTabs(tabs);
			
				});

			});
		}

		

	

		

			var projectTitle ; 

			var projectDescription ; 

			$('document').ready(function(){


				projectTitle = '<?= $workspace->title ?>' ;  

				projectDescription = '<?= $workspace->description ?>' ; 

			});

		


		

		

	
	

		

		//Animation for workspace header

		$('#mywork-dropdown-btn').on('click',function(){

			$('#mywork-dropdown .dropdown-menu').slideToggle();

		});

		$('#browse-dropdown-btn').on('click',function(){

			$('#browse-dropdown .dropdown-menu').slideToggle();

		});


		$('#avatar-dropdown-btn').on('click',function(){

			$('#avatar-dropdown .dropdown-menu').slideToggle();

		});

	
	
</script>
<script src="{{asset('js/projects/change.js')}}"></script>


</body>
</html>