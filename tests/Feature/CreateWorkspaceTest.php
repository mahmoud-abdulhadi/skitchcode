<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateWorkspaceTest extends TestCase
{
    use DatabaseMigrations ; 



    /** @test */ 
    function a_guest_may_not_create_workspaces()
    {


    	$this->disableExceptionHandling();


    	$this->get('/workspaces/create')
    		->assertRedirect('login');



    }

     /** @test */ 
    public function unauthenticated_user_cannot_delete_a_workspace(){

        $this->disableExceptionHandling();

        $workspace = create('App\Workspace');


        $this->delete($workspace->path())
            ->assertRedirect('login');


        $this->signIn();

        $this->delete($workspace->path())
            ->assertStatus(403);

    }


    /** @test */ 
    function an_authenticated_user_can_delete_workspace()
    {

    	$this->signIn();

    	//create a workspace by that user 

    	$workspace = create('App\Workspace',['user_id' => auth()->id()]); 

    	//create a comment on that workspace 

    	$comment = create('App\Comment' , ['commentable_id' => $workspace->id , 'commentable_type' => 'App\Workspace' ]);


    	//when we hit the delete post to delete a workspace 

    	//$this->delete($workspace->path());
    	$this->json('delete',$workspace->path())
    		->assertStatus(204);

    	$this->assertDatabaseMissing('workspaces',['id' => $workspace->id]);


    	$this->assertDatabaseMissing('comments',['id' => $comment->id]);

    	


    	//we assert status 204 (No Content )


    	//we assume the comments table misses that comment 

    	//and that workspace is deleted from the workspaces table 



    }
}
