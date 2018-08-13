<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
	
    use DatabaseMigrations ; 
    protected $thread; 

   	public function setUp(){

			parent::setUp();


			//Create A Reply to used by methods 
			

			//using helpers 

			$this->thread = create('App\Thread');
		}


    /** @test */ 
    public function unauthenticated_user_may_not_add_comments_to_threads(){

    	$this->disableExceptionHandling();

    	$comment = make('App\Comment',['commentable_id' => $this->thread->id , 'commentable_type' => 'App\Thread']);

    	 $this->post("/threads/{$this->thread->channel->slug}/{$this->thread->slug}/comments",$comment->toArray())
    	 ->assertRedirect('/login');

    }

    


    /** @test */

    function an_authenticated_user_may_participate_in_forum_threads(){

        //or the professional way 
        $this->signIn();

        

        //and there is an exsiting thread 

        //using helpers 

        $thread = create('App\Thread');
        //when the user adds a reply 
        
        //using helpers 
        $comment = make('App\Comment');

        $this->post($thread->path().'/comments',$comment->toArray());

        //it should be visible on the thread page 
        //The Reply now is loaded  with Javascript 

        //better to test it with database 
        $this->assertDatabaseHas('comments',['body' => $comment->body]);

        $this->assertEquals(1,$thread->fresh()->comments_count);

    }


      /** @test */ 
    function a_comment_to_thread_requires_body(){

        $this->disableExceptionHandling();
        $this->signIn();

        $comment = make('App\Comment',['body' => null]);

        $this->post($this->thread->path().'/comments',$comment->toArray())
            ->assertSessionHasErrors('body');
    }

     /** @test*/
    public function unauthenticated_user_may_not_reply_to_comments_of_threads()
    {

    	$this->disableExceptionHandling();


    	$comment = create('App\Comment',['commentable_id' => $this->thread->id , 'commentable_type' => 'App\Thread']);


    	$reply = make('App\Comment',['commentable_id' => $comment->id , 'commentable->type' => 'App\Comment']);

    	$this->post($comment->commentable->path().'/comments/{comment}/replies',$reply->toArray())
    		->assertRedirect('/login');

    }

     /** @test */ 
    function authenticated_user_can_reply_to_comments_of_thread()
    {


        $this->signIn();

        // we have a comment to the post 
        $comment = create('App\Comment',['commentable_id' =>$this->thread->id , 'commentable_type' =>'App\Thread']);

        $this->assertEquals(0,$comment->fresh()->commentsCount);

        //we make a reply 

        $reply = make('App\Comment');

        //we post to the comment 

        $this->post($comment->commentable->path().'/comments/'. $comment->id . '/replies',$reply->toArray());

        //we see it in the database

        $this->assertDatabaseHas('comments',[ 'body' => $reply->body]); 

        //we assume the count of coments on that comment is 1 

        $this->assertEquals(1,$comment->fresh()->commentsCount);
    }


    /** @test */
    function thread_comments_that_contain_spam_may_not_be_created(){

        $this->disableExceptionHandling();

        $this->signIn();


        $thread = create('App\Thread');


        $comment = make('App\Comment',[


            'body' => 'WANT TO LOSE WEIGHT?'

        ]);


        
        
        $this->json('post',$thread->path() . '/comments' , $comment->toArray())
            ->assertStatus(422);
    }


    /** @test */ 
    public function users_may_only_reply_a_maximum_of_once_per_minute()
    {

     $this->disableExceptionHandling();


        $this->signIn();


        $thread = create('App\Thread');


        $comment = make('App\Comment',[


            'body' => 'Simple Reply'

        ]);


        $this->post($thread->path() . '/comments' , $comment->toArray())
            ->assertStatus(200);


       $this->post($thread->path() . '/comments' , $comment->toArray())
           ->assertStatus(429);

    }




    
}
