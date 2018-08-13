<template>
<div class="card">
				<div class="card-body level">
					<h4 :id="tag.slug" v-text="tag.name"><span class="fa fa-tag"></span></h4>
					
						<span class=" flex fa fa-trash fa-lg delete-icon" @click="removeTag"></span>
					
				</div>
				<div class="card-footer">
					<span class="item">
						<a :href="filterPosts"><span class="fa fa-book"></span> <span class="badge badge-pill badge-dark">Posts</span></a>
					</span>
					<span class="item">
						<a :href="filterThreads"><span class="fa fa-comments"></span> <span class="badge badge-pill badge-dark"> Discussions</span></a>
					</span>
					<span class="item">
						<a :href="filterSkitches"><span class="fa fa-code"></span> <span class="badge badge-pill badge-dark">Skitches</span></a>
					</span>
					<span class="item">
						<a :href="filterWorkspaces"><span class="fa fa-file-code-o"></span>   
						 <span class="badge badge-pill badge-dark"> Workspaces</span></a>
					</span>
				</div>

			</div>


</template>


<script>
		export default{

			props : ['data'],
			data(){


				return {

					tag : false
				}
			},
			mounted(){

				this.tag = this.data ; 
			},
			computed :{


				filterPosts(){

					return '/posts/tags/' + this.tag.slug ; 
				}, 
				filterSkitches(){


					return '/skitches/tags/' + this.tag.slug ; 
				},
				filterThreads(){

					return '/threads/tags/' + this.tag.slug ; 
				},
				filterWorkspaces(){

					return '/workspaces/tags/' + this.tag.slug ; 
				}
			},
			methods:{

				removeTag(){

						var vm = this ; 
                		alertify
                		.okBtn("Remove")
                		.cancelBtn("Cancel")
                		.confirm("Are You sure you want to delete this Tag?", function (ev) {

                  		// The click event is in the
                  		// event variable, so you can use
                  		// it here.
                  		ev.preventDefault();


                  		axios.delete('/tags/'+vm.tag.slug);

                 		 vm.$emit('deleted',vm.tag);

                  		alertify.error("Tag Removed!");

            			}, function(ev) {

                		  // The click event is in the
                	  	// event variable, so you can use
                 		 // it here.
                  		ev.preventDefault();

                	    alertify.success("Removing Tag Cancelled");

            		});
				
                }
			}
		}

</script>

<style>
	

</style>