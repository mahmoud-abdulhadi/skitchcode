<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WorkspaceTest extends TestCase
{

	use DatabaseMigrations;

	protected $workspace ; 

    public function setUp(){

			parent::setUp();


			//Create A workspace to used by methods 
		

			$this->workspace = create('App\Workspace');
	}

	/** @test */
	public function a_workspace_has_comments()
	{
		

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->workspace->comments);
	}

	/** @test */ 
	public function a_workspace_has_an_author()
	{


		$this->assertInstanceOf('App\User',$this->workspace->author);
	}

	/** @test */ 
	public function a_workspace_can_generate_string_path()
	{


		$path = "/workspaces/{$this->workspace->author->username}/{$this->workspace->id}"; 

		$this->assertEquals($path,$this->workspace->path());
	}

	/** @test */ 
	function workspace_can_have_many_participants(){


		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->workspace->participants);


		

	}

	/** @test */ 
	function workspace_can_add_participants_to_it(){

		//create a workspace 
		$workspace = create('App\Workspace');

		//assert the count of participants in Worksapce 0 
		$this->assertCount(0,$workspace->participants);
		//add User to workspace 

		$workspace->add($user = create('App\User')); 



		//assert The count of participants in Workspace 1 

		$this->assertCount(1,$workspace->fresh()->participants);

	}

	/** @test */ 
	function workspace_can_remove_participants_from_it()
	{

		//create a workspace 

		$workspace = create('App\Workspace');


		//add a user to the workspace 

		$workspace->add($user = create('App\User'));



		//assert count of the participants is 1 
		$this->assertCount(1,$workspace->participants);


		//remove participant form the workspace 

		$workspace->remove($user);


		//assert count of the participants is 0 

		$this->assertCount(0,$workspace->fresh()->participants);
	}


	/** @test */ 

	function workspace_knows_if_a_coder_is_particiapant_in_project()
	{



		$workspace = create('App\Workspace');

		$user = create('App\User');

		$this->assertFalse($workspace->isParticipant($user));

		$workspace->add($user);

		$this->assertTrue($workspace->isParticipant($user));	



	}

	/** @test */ 
	function a_workspace_can_belongs_to_many_tags(){

		$workspace = create('App\Workspace');

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$workspace->tags);

	}


	/** @test */ 
	function a_workspace_can_add_tag(){

		//create a post 



		//count of tags is 0 

		$this->assertCount(0,$this->workspace->tags);


		//create a tag 

		$tag = create('App\Tag');


		//add tag to a post 

		$this->workspace->addTag($tag);




		//count of tags is 1 

		$this->assertCount(1,$this->workspace->fresh()->tags);

	}


	/** @test */ 
	function a_workspace_can_remove_tags(){

		//create a tag 

		$tag = create('App\Tag');


		//add a tag to post 

		$this->workspace->addTag($tag);

		//count of tags is 1 

		$this->assertCount(1,$this->workspace->tags);

		//remove a tag from post 

		$this->workspace->removeTag($tag);

		//count of tags is 0 

		$this->assertCount(0,$this->workspace->fresh()->tags);


	}

}
