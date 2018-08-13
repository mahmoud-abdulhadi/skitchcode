<template>
	<ul class="list-group">
		
		<li class="list-group-item">
			<new-tag @created="add"></new-tag>
		</li>
		<li class="list-group-item" v-for="(tag,index) in tags" :key="tag.id">

			<tag :data="tag" @deleted="remove"></tag>
			
		</li>
		
	</ul>

</template>


<script>
	import Tag from './Tag.vue' ; 
	import NewTag from './NewTag.vue' ; 
	export default {

		components : {Tag , NewTag},
		data(){


			return {


				tags : []
			}
		},
		mounted(){

			axios.get('/tags')
			.then(response => this.tags = response.data);

		},
		methods : {

			remove(tag){
				
				var index = this.tags.indexOf(tag); 

				this.tags.splice(index,1);

				

			},
			add(newTag){


				axios.post('/tags',{name : newTag})
					.then(response => {this.tags.unshift(response.data)}) ; 



					alertify.success('Tag Created Succesfully');
			}
		}
	}


</script>
<style>
	

</style>