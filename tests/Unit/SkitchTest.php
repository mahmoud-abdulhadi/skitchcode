<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SkitchTest extends TestCase
{
	use DatabaseMigrations ; 
   
   public function setUp(){

			parent::setUp();


			//Create A skitch to used by methods 
			

			$this->skitch = create('App\Skitch');
	}

	
	/** @test */ 
	public function a_skitch_has_comments(){

		
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->skitch->comments);

	}

	/** @test */ 
	function a_skitch_has_many_forks(){

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->skitch->forks);
	} 

	/** @test*/
	function a_skitch_may_be_forked_from_another_skitch(){


		$this->signIn();
		//create a skitch 

		$skitch = create('App\Skitch');


		//fork a skitch 

		$forkedSkitch = $skitch->fork();



		//assert the forkable is instance of App\Skitch


		$this->assertInstanceOf('App\Skitch',$forkedSkitch->forkable);


		//Assert the forkable_id is euquals to the original skitch 

		$this->assertEquals($skitch->id,$forkedSkitch->forkable->id);

	}

	/** @test */ 
	function a_skitch_can_fork_another_skitch(){

		//sign IN 

		$this->signIn();

		//create a skitch 

		$originalSkitch = create('App\Skitch');

		//fork skitch 

		$forkedSkitch  = $originalSkitch->fork();


		//assert count of skitches forks 1 

		$this->assertCount(1,$originalSkitch->forks);

		//assert Fork instance of App\Skitch 


		$this->assertInstanceOf('App\Skitch',$forkedSkitch);


		//assert fork forkable_id = skitch_id 
		$this->assertEquals($originalSkitch->id,$forkedSkitch->forkable_id);


		//assert fork user_id == auth_id 

		$this->assertEquals(auth()->id(),$forkedSkitch->user_id);


		//assert code field of fork is equals code field of skitch 
		$this->assertEquals($originalSkitch->code,$forkedSkitch->code);


	}

	/** @test */ 
	public function a_skitch_has_an_author(){

		$this->assertInstanceOf('App\User',$this->skitch->author);
	}

	/** @test */ 
	public function a_skitch_can_generate_string_path(){

		$path = "/skitches/{$this->skitch->author->username}/{$this->skitch->id}" ; 


		$this->assertEquals($path,$this->skitch->path());

	}

	/** @test */
	function before_deleting_skitch_set_null_to_forks_of_it(){


		//create a skitch

		$skitch = create('App\Skitch'); 

		//sign In 

		$this->signIn();
		//fork a skitch 

		$forkedSkitch = $skitch->fork();

		//assert Forked Skitch si forked 

		$this->assertTrue($forkedSkitch->is_forked);


		//assert forked id is id to the skitch id 
		$this->assertEquals($skitch->id,$forkedSkitch->forkable->id);

		$skitch->delete();


		$this->assertNull($forkedSkitch->fresh()->forkable_id);

	}



	/** @test */ 
	function a_skitch_can_belongs_to_many_tags(){

		$skitch = create('App\Skitch');

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$skitch->tags);

	}


	/** @test */ 
	function a_skitch_can_add_tag(){

		//create a post 



		//count of tags is 0 

		$this->assertCount(0,$this->skitch->tags);


		//create a tag 

		$tag = create('App\Tag');


		//add tag to a post 

		$this->skitch->addTag($tag);




		//count of tags is 1 

		$this->assertCount(1,$this->skitch->fresh()->tags);

	}

	/** @test */ 
	function a_skitch_can_remove_tags(){

		//create a tag 

		$tag = create('App\Tag');


		//add a tag to post 

		$this->skitch->addTag($tag);

		//count of tags is 1 

		$this->assertCount(1,$this->skitch->tags);

		//remove a tag from post 

		$this->skitch->removeTag($tag);

		//count of tags is 0 

		$this->assertCount(0,$this->skitch->fresh()->tags);


	}
}
