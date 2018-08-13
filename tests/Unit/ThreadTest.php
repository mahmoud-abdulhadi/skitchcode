<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Notification ; 

use App\Notifications\ThreadWasUpdated ; 

class ThreadTest extends TestCase
{
	use DatabaseMigrations ; 


	protected $thread ;

    public function setUp(){

			parent::setUp();


			//Create A thread to used by methods 
			 

			$this->thread = create('App\Thread');
	}

	/** @test */ 
	public function a_thread_has_comments(){

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->thread->comments);
	}

	/** @test */ 
	public function a_thread_belongs_to_a_channel()
	{

		$this->assertInstanceof('App\Channel',$this->thread->channel);
	}

	/** @test */
	public function a_thread_belongs_to_an_author()
	{



		$this->assertInstanceOf('App\User',$this->thread->author);

	}


	/** @test */ 
	public function a_thread_can_generate_path()
	{

		$path = "/threads/{$this->thread->channel->slug}/{$this->thread->slug}"; 

		$this->assertEquals($path,$this->thread->path());
	}

	/** @test */ 
	public function a_thread_can_be_subscribed_to()
	{

		//create a thread 
		$thread = create('App\Thread');


		//a thread can be subscribed by user
		$thread->subscribe($userId = 1); 

		$this->assertEquals(1,$thread->subscriptions()->where('user_id',1)->count());
	}


	/** @test */ 
	public function a_thread_can_be_unsubscribed_from()
	{

		//create a thread 

		$thread = create('App\Thread'); 


		//subscribe a user to the thread

		$thread->subscribe($userId = 1); 


		//the subscriptions should be 1 

		$this->assertCount(1,$thread->subscriptions);


		//unsubscribe the user from the thread 

		$thread->unsubscribe(1);


		//the count of the subscriptions should be 0 

		$this->assertCount(0,$thread->fresh()->subscriptions);


	}

	/** @test */ 
	public function it_knows_if_authenticated_user_is_subscribed_to(){

		$thread = create('App\Thread');


		$this->signIn();


		$this->assertFalse($thread->isSubscribedTo);

		$thread->subscribe();


		$this->assertTrue($thread->isSubscribedTo);

	}

	/** @test */ 
	public function a_thread_notifies_all_registered_subscribers_when_a_reply_is_added(){

		Notification::fake();


		$this->signIn()
			->thread
			->subscribe()
			->addComment([
				'body' => 'Great Work!!!',
				'user_id' => 999

			]);


			Notification::assertSentTo(auth()->user(),ThreadWasUpdated::class);

	}


	/** @test */ 
	function a_thread_may_be_locked(){

			$this->assertFalse($this->thread->fresh()->locked);

			
			$this->thread->lock();


			$this->assertTrue($this->thread->locked);


		}

	/** @test */ 
	function a_thread_can_belongs_to_many_tags(){

		$thread = create('App\Thread');

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$thread->tags);

	}


	/** @test */ 
	function a_thread_can_add_tag(){

		//create a post 



		//count of tags is 0 

		$this->assertCount(0,$this->thread->tags);


		//create a tag 

		$tag = create('App\Tag');


		//add tag to a post 

		$this->thread->addTag($tag);




		//count of tags is 1 

		$this->assertCount(1,$this->thread->fresh()->tags);

	}


	/** @test */ 
	function a_thread_can_remove_tags(){

		//create a tag 

		$tag = create('App\Tag');


		//add a tag to post 

		$this->thread->addTag($tag);

		//count of tags is 1 

		$this->assertCount(1,$this->thread->tags);

		//remove a tag from post 

		$this->thread->removeTag($tag);

		//count of tags is 0 

		$this->assertCount(0,$this->thread->fresh()->tags);


	}
}
