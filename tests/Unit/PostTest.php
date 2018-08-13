<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){

			parent::setUp();


			//Create A post to used by methods 
			 

			//using helpers 

			$this->post = create('App\Post');
		}


	/** @test */ 
	public function a_post_has_comments(){

		
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->post->comments);

	}

	/** @test */ 
	public function a_post_belongs_to_a_category(){

		$this->assertInstanceOf('App\Category',$this->post->category);
	}


	/** @test */
	public function a_post_has_an_author(){

		$this->assertInstanceOf('App\User',$this->post->author);
	}


	/** @test */ 
	public function a_post_can_generate_string_path(){

		$path = "/posts/{$this->post->category->slug}/{$this->post->slug}" ; 


		$this->assertEquals($path,$this->post->path());


	}

	/** @test */ 
	function a_post_can_belongs_to_many_tags(){
		$post = create('App\Post');

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$post->tags);

	}

	/** @test */ 
	function a_post_can_add_tag(){

		//create a post 



		//count of tags is 0 

		$this->assertCount(0,$this->post->tags);


		//create a tag 

		$tag = create('App\Tag');


		//add tag to a post 

		$this->post->addTag($tag);




		//count of tags is 1 

		$this->assertCount(1,$this->post->fresh()->tags);

	}


	/** @test */ 
	function a_post_can_remove_tags(){

		//create a tag 

		$tag = create('App\Tag');


		//add a tag to post 

		$this->post->addTag($tag);

		//count of tags is 1 

		$this->assertCount(1,$this->post->tags);

		//remove a tag from post 

		$this->post->removeTag($tag);

		//count of tags is 0 

		$this->assertCount(0,$this->post->fresh()->tags);


	}
}

