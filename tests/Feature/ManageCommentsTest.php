<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageCommentsTest extends TestCase
{
   
	use DatabaseMigrations ; 

	/** @test */ 

	public function unauthenticated_user_can_not_delete_comment()
	{

		$this->disableExceptionHandling();

		$comment = create('App\Comment');


		$this->delete('/comments/'.$comment->id)
			->assertRedirect('/login');

		$this->signIn()
			->delete("/comments/{$comment->id}")
			->assertStatus(403);



	}

	/** @test */ 
	public function authenticated_user_can_delete_comment()
	{
		//sign In a user 

		$this->signIn();

		//create a comment that belongs to that user 
		$comment = create('App\Comment',['user_id' => auth()->id()]); 


		$this->assertEquals(1,$comment->commentable->commentsCount);

		//hit the endpoint to delete the comment 


		$this->delete("/comments/{$comment->id}")
			->assertStatus(302);

		//the database should miss this comment 

		$this->assertDatabaseMissing('comments',['id' => $comment->id]);


		//the commentable comments count should contains 0  


		$this->assertEquals(0,$comment->commentable->commentsCount);

	}

	/** @test */ 

	function unauthorized_user_can_not_update_comments()
	{


		$this->disableExceptionHandling();


		$comment = create('App\Comment');

		$this->patch("/comments/{$comment->id}",[])
			->assertRedirect('/login');


		$this->signIn()
			->patch("/comments/{$comment->id}",[])
				->assertStatus(403);




	}


	/** @test */ 
	function authorized_user_can_update_comments(){

		//sign In 

		$this->signIn();

		//create a comment by that user 
		$comment = create('App\Comment',['user_id' => auth()->id()]);


		//make A new comment body  

		$newComment = 'A New Update' ; 


		//hit the endpoint to update the commnet by that reply 
		$this->patch("/comments/{$comment->id}",['body' => $newComment]);

		//assert the database have been updated

		$this->assertDatabaseHas('comments',['id' => $comment->id , 'body' => $newComment]);

	}


	/** @test */
	function updated_comments_by_authorized_users_should_not_contain_spam()
	{

		//sign In 

		$this->signIn();

		//create a comment by that user 
		$comment = create('App\Comment',['user_id' => auth()->id()]);


		//make A new comment body  

		$newComment = 'sssssssssa' ; 


		//hit the endpoint to update the commnet by that reply 
		$this->patch("/comments/{$comment->id}",['body' => $newComment])
			->assertStatus(422);

	}

}
