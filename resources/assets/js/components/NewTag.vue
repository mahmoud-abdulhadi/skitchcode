<template>
	
	<div class="mb-4 create-tag">
		<button class="btn btn-success btn-lg" @click="creating=true"><span class="fa fa-plus-circle"></span> Create new Tag</button>
	
		<div v-if="creating == true" class="mt-4 form-group">
			<input type="text" class="form-control" placeholder="New Tag Title" autofocus @keydown.enter="save" v-model="newTag"/>
			<button class="btn btn-light mt-3" @click="creating=false">Cancel</button>

		</div>

	</div>

</template>

<script>
	
export default {

		data(){



			return {


				creating : false ,
				newTag : ''
			}
		},
		methods :{


			save(){

				if(this.newTag == ''){

					var message = "<h3>Please Provide a Title for the New Tag</h3>" ; 
					alertify.logPosition("top left");
					alertify.error(message);



					return ; 
				}


				this.$emit('created',this.newTag);


				this.creating = false ; 

				this.newTag = '' ; 

			
			}
		}
	}

</script>

<style>
	.create-tag .form-control{


		border-radius: 0px ; 

		border : 1px solid #000;
	}

	.create-tag .btn {

		border-radius: 0px ; 
	}

</style>