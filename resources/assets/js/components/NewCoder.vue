<template>

	<div class="row mt-2 mb-2">
		<div class="col-md-10">
		<input type="text" class="form-control" id="newCoder" placeholder="Add new Coder" v-model="newCoder">
		</div>
		<div class="col-md-1">
			<span class="fa fa-user-plus " title="Add new Participant" @click="addCoder"></span>
		</div>
	</div>
</template>


<script>
	import 'jquery.caret' ; 

	import 'at.js' ; 

	export default{
		data(){

			return {

				newCoder: ''
			}

		},
		mounted(){

				axios.get('/api/users')
					.then(response => {


						let originalUsers = response.data ; 

						let users = [] ; 
						for(let i = 0 ; i < originalUsers.length;i++){


							let newUser = {

								id : i , 
								username : originalUsers[i].username , 
								avatar : originalUsers[i].avatar ,
							}

							users.push(newUser);

						}

						$('#newCoder').atwho({

							at : '@'  , 
							data : users , 
							headerTpl : '<div class="atwho-header">Member List<small>↑&nbsp;↓&nbsp;</small></div>',
							displayTpl : '<li><img src="${avatar}" width="20" height="20"> ${username}</li>',
							insertTpl : '${username}',
							limit : 100
						})

					});


					$('#newCoder').atwho('run');

				
				/*$('#newCoder').atwho({
					at  : '@' , 
					delay : 750 ,

					data: results , 

					displayTpl : '<li>${username}</li>',

			
					/*callbacks : {

						remoteFilter : function(query,callback){


							$.getJSON('/api/users',{username:query},function(user){
								
								callback(user.usernames);
							})
						}

					}*/

				//});

		},
		methods:{

			addCoder(){

				if(this.newCoder == ''){

					var message = "<h5>Please Provide a Username for the New Coder</h5>" ; 
					alertify.logPosition("bottom left");
					alertify.error(message);
						return ; 
				}

				let coderUsername =  '' ; 


				let newCoder  = document.querySelector('#newCoder').value ; 

				

				/*return ; 

				let indexOfSpace = newCoder.indexOf(' ');

				

				if(indexOfSpace < 0 ){

					coderUserName = newCoder.substr(1);

				}else {

					coderUsername = newCoder.substr(1,indexOfSpace-1);

				}


				//console.log(username);*/

				
				
				coderUsername = newCoder ; 

				this.$emit('created',coderUsername);


				this.newCoder = '' ; 
			}


		}

	}
</script>


<style>
	.form-control{

		border-radius: 0px;
		outline: none;

		
		border : 0px;

		font-style: italic;

		font-weight: 600 ;

	}



	.fa-user-plus {

		color : #FFF;
		background : #000;

		border-radius: 50%;
		margin-left: -20px;
		padding : 8px;
		cursor : pointer;


	}

	.fa-user-plus:hover{

	background : #198764;
	}

</style>