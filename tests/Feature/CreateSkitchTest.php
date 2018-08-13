<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateSkitchTest extends TestCase
{
    

	use DatabaseMigrations ; 



	/** @test */ 
	public function a_guest_may_not_create_skitch(){

		$this->disableExceptionHandling();

		$this->get('/skitch')
			->assertRedirect('login');

			
	}


	/** @test */ 
	
	public function unauthorized_user_can_not_delete_skitch(){

		$this->disableExceptionHandling();

		$skitch = create('App\Skitch');


		$this->delete($skitch->path())
			->assertRedirect('login');


		$this->signIn();

		$this->delete($skitch->path())
			->assertStatus(403);

	}

	/** @test */ 
	public function an_authorized_user_can_delete_skitch(){

		$this->signIn();

		$skitch = create('App\Skitch',['user_id' => auth()->id()]); 


		$comment = create('App\Comment',['commentable_id' => $skitch->id,'commentable_type' => 'App\Skitch']);


		$this->json('DELETE',$skitch->path())
			->assertStatus(204);

		$this->assertDatabaseMissing('skitches',['id' => $skitch->id]);

		$this->assertDatabaseMissing('comments',['id' => $comment->id]);

	}


}
