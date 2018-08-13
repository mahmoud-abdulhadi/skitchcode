<template>
	
	<li class="nav-item dropdown">
             
              <a id="notification-button" class="nav-link " href="#"  role="button"  aria-haspopup="true" aria-expanded="false">
              		<span class="fa fa-bell fa-lg"></span>
              			<span class="badge badge-light" v-text="notifications.length" v-if="notifications.length"></span>
              	</a>
               <div id="notification-dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<p v-if="notifications.length">
					<a  class="dropdown-item" :href="notification.data.link" v-for="notification in notifications" v-html="notification.data.message" @click="markAsRead(notification)"></a>
				</p>
	
                <p v-else>No Notifications for you at this time</p>
                <div class="dropdown-divider"></div>
                <a href="#"><span class="fa fa-feed"></span> Your Activity</a>
             </div>
               
          
        </li>


</template>


<script>
	export default {

		data(){



			return { 

				notifications : []
			}
		},
		mounted(){



			//fetch the unread notifications for user 
			let user = window.App.user.username ; 


			axios.get('/profiles/' + user + '/notifications')
				.then(response => this.notifications = response.data) ; 
		},

		methods :{



			markAsRead(notification){

					let username = window.App.user.username ; 

					let notificationId = notification.id ; 


					axios.delete('/profiles/' + username + '/notifications/' + notificationId); 


			}
		}



	}


</script>

<style>
	
	.dropdown-menu  a {


		color : #1F1F41;
	}

</style>