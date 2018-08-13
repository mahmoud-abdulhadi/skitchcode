<template>

	<div>
		

		<new-category @created="add"></new-category>
		<div v-for="(category,index) in categories" :key="category.id">

			<category :data="category" @deleted="remove"></category>

		</div>
			

	
	</div>

	

	
</template>


<script>
	
	import Category from './Category.vue' ; 

	import NewCategory from './NewCategory.vue' ; 

	export default {
			
		
		components : {Category , NewCategory},
		data(){

		return {


			categories : [],
			

		} ; 
	},
		mounted(){

			axios.get('/categories')
				.then(response => this.categories = response.data);
			
		},

	methods : {


			remove(category){
				
				var index = this.categories.indexOf(category); 

				this.categories.splice(index,1);

				

			},
			add(newCategory){


				axios.post('/categories',{title : newCategory})
					.then(response => {this.categories.unshift(response.data)}) ; 



					alertify.success('Category Created Succesfully');
			}
	}
}

</script>

<style>
	
	.item .card-header {

		background : #191919;
		color : white;
	}

	.item .btn {

		border-radius: 0px
	}

	.item a { 

		color : #AAA;

		text-decoration: none ; 
	 }

	.item a:hover {

	 	background: white ; 

	 	text-decoration: none ; 
	 	padding :6px;
	 	border-radius: 10px;
	 	color : black;
	 }

	 .item .form-control {
		


	 	font-style: "Lato", "Lucida Grande", "Lucida Sans Unicode", Tahoma, Sans-Serif;

	 	font-size: 1.3em;
	 	font-weight: bold ; 

	 	background : #000;
	 	color : #FFF;

	 	border-radius: 0px;
	 }
</style>