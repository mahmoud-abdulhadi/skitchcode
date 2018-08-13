<template>
           
    <div  class="card item mb-3">
                <div class="card-header">
                    <div v-if="editing==false">
                        <h4><a :href="channel.path">{{this.body}}</a></h4>
                    </div>
                    <div v-if="editing==true">
                        <div class="form-group">
                        <input type="text" class="form-control" v-model="body" autofocus>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-sm" @click="update">Update</button>
                            <button class="btn btn-link btn-sm" @click="editing=false">Cancel</button>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <h5><span class="badge badge-dark">{{channel.threads_count}}</span> Discussions </h5>
                </div>
                <div class="card-footer">
                    <button class="btn btn-info btn-sm" title="Edit" @click="editing=true"><span class="fa fa-edit"></span></button>
                    <button class="btn btn-danger btn-sm ml-5" @click="remove"><span class="fa fa-trash"></span></button>
                </div>
            </div> 
      
</template>

<script>
    export default {
        props : ['data'],
        data(){


            return {


                channel : false , 
                editing : false,
                body : ''
            }
        },
        mounted(){

            this.channel = this.data ; 

            this.body = this.channel.title ; 
        },
        methods :{


            update(){
                if(this.body == ''){

                    var message = "<h3>Please Provide a Title for the Channel</h3>" ; 
                    alertify.logPosition("top left");
                    alertify.error(message);


                    this.body = this.channel.title ; 

                    return ; 
                }
                axios.patch('/channels/' + this.channel.slug,{title : this.body}) ; 

                this.editing = false ; 

                alertify.success('Channel Updated Successfully!');
            },
        remove(){

                var vm = this ; 
                alertify
                .okBtn("Remove")
                .cancelBtn("Cancel")
                .confirm("Are You sure you want to delete this Channel<span class='text-danger'>All Related Discussions will be Deleted</span>?", function (ev) {

                  // The click event is in the
                  // event variable, so you can use
                  // it here.
                  ev.preventDefault();


                  axios.delete('/channels/'+vm.channel.slug);

                  vm.$emit('deleted',vm.channel);

                  alertify.error("Channel Removed!");

            }, function(ev) {

                  // The click event is in the
                  // event variable, so you can use
                  // it here.
                  ev.preventDefault();

                  alertify.success("Removing Channel Cancelled");

            });






            }
        }
       
    }
</script>
