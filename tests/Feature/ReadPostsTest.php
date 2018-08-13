<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadPostsTest extends TestCase
{

	use DatabaseMigrations ; 

	protected $post ; 

	protected function setUp(){


		parent::setUp();


		$this->post = create('App\Post');
	}


	/** @test */ 

	public function a_user_can_view_all_posts(){

		


		$this->get('/posts')
			->assertStatus(200)
			->assertSee($this->post->title);
	}

	/** @test */ 
	public function a_user_can_view_single_post()
	{


		$this->get($this->post->path())
			->assertStatus(200)
			->assertSee($this->post->title)
			->assertSee($this->post->content);

	}

	/** @test */ 
	public function a_user_can_filter_posts_according_to_a_category(){


		$category = create('App\Category');


		$postInCategory = create('App\Post',['category_id' => $category->id]);


		$postNotInCategory = create('App\Post');



		$this->get('posts/'.$category->slug)
			->assertSee($postInCategory->title)
			->assertDontSee($postNotInCategory->title);
	}


	 /** @test */
    public function a_user_can_filter_posts_by_any_username(){


        //signIn A new User 

        $this->signIn(create('App\User',['username' => 'mahmoud.hadi']));


        //create a thread by that user

        $postByUser = create('App\Post',['user_id' => auth()->id()]); 

        //create a thread not by that user 
        $postNotByUser = create('App\Post');


        //when hitting endpoint fetch the threads created by that user not by else users

       $this->get('/posts?by=mahmoud.hadi')
            ->assertSee($postByUser->title) 

           ->assertDontSee($postNotByUser->title);


    }

     /** @test */ 

    function a_user_can_filter_posts_by_tags(){

         //we create a Tag 

        $tag = create('App\Tag');



        //create a post and attach tag to it  

        $postWithTag = create('App\Post');

        $postWithTag->addTag($tag);


        //create a post not attached with that tag 

        $postWithoutTag = create('App\Post');


        //when we hit the endpoint of filtering 

        $this->get('/posts/tags/'. $tag->slug)

        //We see the post that attached to the tag  
            ->assertSee($postWithTag->title)

        //and doesn't see the post that doesn't attached to the tag 
            ->assertDontSee($postWithoutTag->title);
    }


	/** @test */ 
	function it_records_new_view_each_time_a_post_is_read(){


		$post = create('App\Post');

		$this->assertSame(0,$post->views);


		$this->call('GET',$post->path());


		$this->assertEquals(1,$post->fresh()->views);


	}


	  /** @test */ 
    function a_user_can_fetch_posts_tags(){

        //create a Post
        $post = create('App\Post');


        //count of post tags is 0 

        $this->assertCount(0,$post->tags);

        //create two tags 

        $tag1 = create('App\Tag');

        $tag2 = create('App\Tag');

        //attach those tags to post 
        $post->addTag($tag1);

        $post->addTag($tag2);

        $this->assertCount(2,$post->fresh()->tags);


        //fetch the skitch tags json
       $results = $this->getJson($post->path(). '/tags')->json();


        //count of skitch tags should be 2 

       $this->assertCount(2,$results);


    }
   
}
