<template>

	<div>
		

		<new-channel @created="add"></new-channel>
		<div v-for="(channel,index) in channels" :key="channel.id">

			<channel :data="channel" @deleted="remove"></channel>

		</div>
			

	
	</div>

	

	
</template>


<script>
	
	import Channel from './Channel.vue' ; 

	import NewChannel from './NewChannel.vue' ; 

	export default {
			
		
		components : {Channel , NewChannel},
		data(){

		return {


			channels : [],
			

		} ; 
	},
		mounted(){

			axios.get('channels')
				.then(response => this.channels = response.data);
			
		},

	methods : {


			remove(channel){
				
				var index = this.channels.indexOf(channel); 

				this.channels.splice(index,1);

				

			},
			add(newChannel){


				axios.post('channels',{title : newChannel})
					.then(response => {this.channels.unshift(response.data)}) ; 



					alertify.success('Channel Created Succesfully');
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