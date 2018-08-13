<template>
	
	<div class="mb-4 create-category">
		<button class="btn btn-success btn-lg" @click="creating=true"><span class="fa fa-plus-circle"></span> Create new Category</button>
	
		<div v-if="creating == true" class="mt-4 form-group">
			<input type="text" class="form-control" placeholder="New Category Title" autofocus @keydown.enter="save" v-model="newCategory"/>
			<button class="btn btn-link" @click="creating=false">Cancel</button>

		</div>

	</div>

</template>


<script>
	
	export default {

		data(){



			return {


				creating : false ,
				newCategory : ''
			}
		},
		methods :{


			save(){

				if(this.newCategory == ''){

					var message = "<h3>Please Provide a Title for the New Category</h3>" ; 
					alertify.logPosition("top left");
					alertify.error(message);



					return ; 
				}


				this.$emit('created',this.newCategory);


				this.creating = false ; 

				this.newCategory = '' ; 

			
			}
		}
	}

</script>

<style>
	.create-category .form-control{


		border-radius: 0px ; 

		border : 1px solid #000;
	}

	.create-category .btn {

		border-radius: 0px ; 
	}


</style>