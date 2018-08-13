<template>
	
	<div class="col-md-3 offset-md-1 all-section">
		
		<div class="details-section-header">Coders 
		<span class="pull-right meta-count" >{{coders.length}} Coders</span>
		</div>

		<new-coder v-if="canAdd" @created="add"></new-coder>

		<div v-for="(coder,index) in coders" :key="coder.id">
			<coder :data="coder" @deleted="removeCoder"></coder>
		</div>
	</div>

</template>


<script>

import Coder from './Coder.vue' ;

import NewCoder from './NewCoder.vue' ; 
	
export default {

	props : ['data','workspace'] , 
	components :{Coder , NewCoder},
	data(){


		return {

			coders : this.data
		}
	},
	computed : {
		canAdd(){


			return window.App.canRemove ; 
		},
		postUrl(){

			let workspaceId = this.workspace.id ; 

			return '/workspaces/' + workspaceId + '/participants' ; 
		}
	},
	methods : {

		removeCoder(coder){

				var index = this.coders.indexOf(coder); 

				this.coders.splice(index,1);


		},
		add(coderUsername){

			 
				for(let i = 0 ; i < this.coders.length;i++){

					if(this.coders[i].username == coderUsername){


						alertify.error(coderUsername +' is already In The project!');

						return ; 
					}
				}
			
				axios.post(this.postUrl,{username : coderUsername})
					.then(response =>{ 

						this.coders.unshift(response.data);
						let name = response.data.name ; 

						let message = '<h5>' + name + ' Added to project Successfully!</h5>'; 
						alertify.success(message);
					})
					.catch(error => alertify.error(error)) ; 



					
		}

	}
}

</script>


<style>
	


</style>