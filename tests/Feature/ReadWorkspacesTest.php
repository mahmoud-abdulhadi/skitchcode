<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadWorkspacesTest extends TestCase
{
    
	use DatabaseMigrations ; 

	protected $workspace ; 
	protected function setUp()
	{

		parent::setUp();


		$this->workspace = create('App\Workspace');
	}

    /** @test */
    public function a_user_can_view_all_workspaces(){

    	$this->get('/workspaces')
    		->assertStatus(200)
    		->assertSee($this->workspace->title);
    }

    /** @test */
    public function a_user_can_view_single_workspace()
    {

    	$this->get($this->workspace->path())
    		->assertSee($this->workspace->title)
    		->assertSee($this->workspace->description) ; 

    }


    /** @test */ 
    function it_records_new_view_each_time_a_workspace_is_read(){


        $workspace = create('App\Workspace');

        $this->assertSame(0,$workspace->views);


        $this->call('GET',$workspace->path());


        $this->assertEquals(1,$workspace->fresh()->views);


    }



    /** @test */
    public function a_user_can_filter_workspaces_by_any_username(){


        //signIn A new User 

        $this->signIn(create('App\User',['username' => 'mahmoud.hadi']));


        //create a skitch by that user

        $workspaceByUser = create('App\Workspace',['user_id' => auth()->id()]); 

        //create a skitch not by that user 
        $workspaceNotByUser = create('App\Workspace');


        //when hitting endpoint fetch the threads created by that user not by else users

       $this->get('/workspaces/' . auth()->user()->username)
            ->assertSee($workspaceByUser->title) 

           ->assertDontSee($workspaceNotByUser->title);


    }


     /** @test */ 

    function a_user_can_filter_workspaces_by_tags(){

         //we create a Tag 

        $tag = create('App\Tag');



        //create a workspace and attach tag to it  

        $workspaceWithTag = create('App\Workspace');

        $workspaceWithTag->addTag($tag);


        //create a workspace not attached with that tag 

        $workspaceWithoutTag = create('App\Workspace');


        //when we hit the endpoint of filtering 

        $this->get('/workspaces/tags/'. $tag->slug)

        //We see the workspace that attached to the tag  
            ->assertSee($workspaceWithTag->title)

        //and doesn't see the workspace that doesn't attached to the tag 
            ->assertDontSee($workspaceWithoutTag->title);
    }

     /** @test */ 
    function a_user_can_fetch_workspaces_tags(){

        //create a Workspaces
        $workspace = create('App\Workspace');


        //count of skitch tags is 0 

        $this->assertCount(0,$workspace->tags);

        //create two tags 

        $tag1 = create('App\Tag');

        $tag2 = create('App\Tag');

        //attach those tags to workpsace 
        $workspace->addTag($tag1);

        $workspace->addTag($tag2);

        $this->assertCount(2,$workspace->fresh()->tags);


        //fetch the skitch tags json
       $results = $this->getJson($workspace->path(). '/tags')->json();


        //count of skitch tags should be 2 

       $this->assertCount(2,$results);


    }
}
