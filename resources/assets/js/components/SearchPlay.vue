<template>
	
<li class="nav-item">
		<transition name="slide-fade">	
         <a  v-if="!searching" id="search-button" href="#" class="nav-link" @click.prevent="displayBox"><span class="fa fa-search fa-lg"></span></a>
         </transition>
         <transition name="slide-fade">
	     	   <div class="input-group mb-3" v-if="searching">
	   			 <div class="input-group-prepend">
	      		<span class="input-group-text"><i class="fa fa-search"></i></span>
	   		 </div>
	    		<input  id="searchBox" type="text" class="form-control" placeholder="Search" @blur="searching=false">
	  	</div>
  	</transition>
 </li>

</template>

<script>
	
 export default{


 	data(){


 		return {


 			searching : false ,
 			query  : ''
 		}
 	},

 	methods :{


 		displayBox(){

 			this.searching = true ; 

 			document.querySelector('#searchBox').focus();

 		}
 	}

 }

</script>


<style>
	
 #searchBox { 
	background : #3A3B3A;
	
	color : white;

	width:400px;

	font-weight: 500 ; 

	font-style: italic;

	border-radius : 0px;
	border-color: #41B883;
	
  }

  input:focus{

  	outline : none;
  }

  .slide-fade-enter-active {
  transition: all .3s ease;
   transition-delay: 0.3s ;
}
.slide-fade-leave-active {
  transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);

}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}

</style>