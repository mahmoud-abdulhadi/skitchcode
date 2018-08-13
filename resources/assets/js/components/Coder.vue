<template>
			<div class="username">
			<a :href="coderProfile" >
										<img :src="coderAvatar"  class="avatar" :alt="coderName">
										<span class="username-text" v-text="coder.name"></span>
										
			</a>
			<span v-if="canRemove" class="fa fa-window-close" @click="remove"></span>
			</div>
	
</template>

<script>
	export default {

		props : ['data'],
		data(){


			return {


				coder : this.data
			}
		},
		computed : {

			coderProfile(){

				return '/profiles/' + this.coder.username ; 
			},
			coderAvatar(){

				return this.coder.avatar ; 
			},
			coderName(){

				return this.coder.name ; 
			},
			deleteUrl(){

				let workspaceId = this.coder.pivot.workspace_id ; 

				let username = this.coder.username ; 

				return '/workspaces/' + workspaceId  + /participants/ + username ; 
			},
			canRemove(){

				return window.App.canRemove ; 
			}

		},

		methods : {


			remove(){
				var vm = this ; 
                		alertify
                		.okBtn("Remove")
                		.cancelBtn("Cancel")
                		.confirm("Are You sure you want to delete " +vm.coder.name +  " from Project?", function (ev) {

                  		// The click event is in the
                  		// event variable, so you can use
                  		// it here.
                  		ev.preventDefault();


                  		axios.delete(vm.deleteUrl);

                 		 vm.$emit('deleted',vm.coder);

                  		alertify.error("Coder Removed from project!");

            			}, function(ev) {

                		  // The click event is in the
                	  	// event variable, so you can use
                 		 // it here.
                  		ev.preventDefault();

                	    alertify.success("Removing Coder Cancelled");

            		});
				
			}
		}



}

</script>

<style>
	
	.fa-window-close{
		position : absolute;
		right : 30px;
		color :white;
	}

	.fa-window-close:hover {

		color : red;

		cursor : pointer ;

		background : #222;

	}
</style>