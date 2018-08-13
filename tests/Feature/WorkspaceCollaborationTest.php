<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkspaceCollaborationTest extends TestCase
{
    use DatabaseMigrations ; 


    /** @test */ 
    function workspace_author_can_add_other_users_to_collaborate(){


    	//signIn 
    	$this->signIn();

    	//create a workspace 

    	$workspace = create('App\Workspace',['user_id' => auth()->id()]);


    	//hit endpoint to add User to workspace 

    	$user= create('App\User') ; 


    	$this->postJson("/workspaces/{$workspace->id}/participants", [

    			'username' => $user->username 
    	]);	


    	$this->assertCount(1,$workspace->fresh()->participants);


    	$this->assertDatabaseHas('participants',['user_id' => $user->id]);

    } 

    /** @test */ 
    function workspace_author_can_remove_participants(){
        //signIn 
        $this->signIn();

        //create a workspace 

        $workspace = create('App\Workspace',['user_id' => auth()->id()]);


        //hit endpoint to add User to workspace 
        $user = create('App\User');
        $workspace->add($user); 


        $this->assertCount(1,$workspace->participants);

        $this->deleteJson('/workspaces/' .$workspace->id . '/participants/' . $user->username) ; 


        $this->assertCount(0,$workspace->fresh()->participants);


        $this->assertDatabaseMissing('participants',['user_id' => $user->id]);


    }
    /** @test */ 
    function user_can_fetch_workspace_participants()
    {


        $workspace = create('App\Workspace');

        $user = create('App\User');

        $workspace->add($user);

       $participants = $this->getJson($workspace->path() . '/participants')->json();

        $this->assertCount(1,$participants);

      

        $this->assertEquals($user->username,$participants[0]['username']);


    }

    /** @test */ 
    function unauthorized_users_cannot_add_coders_to_project(){

        $this->disableExceptionHandling();
        //create a workspace 

        $workspace = create('App\Workspace');


        //signIn 

        $this->signIn();

        //try to add participants to that workspace 

        $this->postJson("/workspaces/{$workspace->id}/participants",[

            'user_id' => auth()->id()
        ])->assertStatus(403);

        //The response that you are not authorized 


    }


    /** @test */ 
    function unauthorized_users_can_not_delete_coders_from_projects()
    {

        //create a workspaces 

        $workspace = create('App\Workspace');


        //add two users to it 

        $workspace->add($user1 = create('App\User'));

        $workspace->add($user2 = create('App\User')); 


        //create a thirds user 

        $outsiderUser = create('App\User'); 


        //when the outisiders try to delete one refuse it

        $this->signIn($outsiderUser);

        $this->deleteJson('/workspaces/' .$workspace->id . '/participants/' . $user1->username)
            ->assertStatus(403);


        // when one of participants try to delete another participant fails 
            $this->signIn($user2);


        $this->deleteJson('/workspaces/' .$workspace->id . '/participants/' . $user1->username)
            ->assertStatus(403,'Unauthorized to remove other user from project');




    }

    /** @test */ 
    function a_participant_can_Delete_himself_from_a_project()
    {

        //create workspace 

        $workspace = create('App\Workspace');


        //add a user to this workspace 

        $workspace->add($user = create('App\User'));


        //sanity check 

        $this->assertTrue($workspace->isParticipant($user));

       //signIn as this user 

       //$this->signIn($user);

       //when he hit the endpoint to delete himself it is deleted 

       //$this->deleteJson("/workspaces/{$workspace->id}/participants/{$user->username}")
         //   ->assertStatus(200);

        //makesure it is really deleted

        //$this->assertFalse($workspace->isParticipant($user));


    }

    /** @test */ 
    function participants_of_workspace_are_notified_when_adding_participant(){

        //create a workspace 

        $workspace = create('App\Workspace');



        //create two users 

        $user1 = create('App\User');

        $user2 = create('App\User');


        $workspace->add($user1);

        $this->assertCount(1,$user1->notifications);

        

        //add theses users to the workspace 

        $workspace->add($user2);

        $this->assertCount(1,$user2->fresh()->notifications);

      // $this->assertCount(2,$workspace->fresh()->participants);


       

        
        $this->assertCount(2,$user1->fresh()->notifications);




        //create third user 


        //add third user to the workspace 

        //assert notification in all three users


    }


    /** @test */ 

    function workspace_record_changes_when_participants_modify_workspace(){


        //create a workspace 

        $workspace = create('App\Workspace');


        //create a user1 
        $user1 = create('App\User');

        //create user2 

        $user2 = create('App\User');

        //add participant 

        $workspace->add($user1);

        //add participant 
        $workspace->add($user2);

        //sign In as user 1 

        $this->signIn($user1);

        //update workspace 
        $workspace->update(['title' => 'New Title']);


        //Sign In as User2 

        $this->signIn($user2);

        //Update Workspace 

        $workspace->update(['description' => 'Workspace to Demonstrate Diff Tool']);

       // dd($workspace->changes[1]->pivot->after);
        //count of workspace changes should be 2 

        $this->assertCount(2,$workspace->changes);



    }


}
