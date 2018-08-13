<template>
	
	<div class="mb-4 create-channel">
		<button class="btn btn-success btn-lg" @click="creating=true"><span class="fa fa-plus-circle"></span> Create new Channel</button>
	
		<div v-if="creating == true" class="mt-4 form-group">
			<input type="text" class="form-control" placeholder="New Channel Title" autofocus @keydown.enter="save" v-model="newChannel"/>
			<button class="btn btn-link" @click="creating=false">Cancel</button>

		</div>

	</div>

</template>


<script>
	
	export default {

		data(){



			return {


				creating : false ,
				newChannel : ''
			}
		},
		methods :{


			save(){

				if(this.newChannel == ''){

					var message = "<h3>Please Provide a Title for the New Channel</h3>" ; 
					alertify.logPosition("top left");
					alertify.error(message);



					return ; 
				}


				this.$emit('created',this.newChannel);


				this.creating = false ; 

				this.newChannel = '' ; 

			
			}
		}
	}

</script>

<style>
	.create-channel .form-control{


		border-radius: 0px ; 

		border : 1px solid #000;
	}

	.create-channel .btn {

		border-radius: 0px ; 
	}


</style>