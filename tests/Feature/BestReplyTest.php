<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BestReplyTest extends TestCase
{
    use DatabaseMigrations ; 
     /** @test */ 
    function a_thread_creator_may_mark_any_reply_as_the_best_answer(){

    	$this->signIn();


    	$thread = create('App\Thread',['user_id' => auth()->id()]); 

    	$comments = create('App\Comment',['commentable_id' =>$thread->id ,'commentable_type' => 'App\Thread'],2);

    	$this->assertFalse($comments[1]->isBest);

    	$this->postJson(route('best-reply.store',[$comments[1]->id]));

    	$this->assertTrue($comments[1]->fresh()->isBest);


    }


    /** @test */ 
    function only_the_thread_creator_may_mark_reply_as_best(){

        $this->disableExceptionHandling();


        $this->signIn();

        $thread = create('App\Thread',['user_id' => auth()->id()]);

        $comments = create('App\Comment',['commentable_id' => $thread->id, 'commentable_type' => 'App\Thread'],2);

        $this->signIn(create('App\User'));

        $this->postJson(route('best-reply.store',[$comments[1]->id]))->assertStatus(403);

        $this->assertFalse($comments[1]->fresh()->isBest);


    }


    /** @test */ 
    function if_a_best_reply_is_deleted_then_the_thread_is_properly_updated_to_reflect_that(){


            $this->signIn();

            $comment = create('App\Comment',['user_id' => auth()->id()]); 


            $comment->commentable->markBestReply($comment);


            //let's delete this reply 
            $this->deleteJson("/comments/{$comment->id}"); 

            $this->assertNull($comment->commentable->fresh()->best_reply_id);



    }
}
