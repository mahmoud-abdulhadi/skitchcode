<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostsTest extends TestCase
{
  use DatabaseMigrations ; 

  /** @test*/
  public function a_guest_may_not_create_post(){

    $this->disableExceptionHandling();


    $this->get('posts/create')
      ->assertRedirect('login');


  }

  /** @test */
  public function a_post_requires_a_unique_slug(){

  	//create a post with a title 

  	$post = create('App\Post',['title' => 'Some New Title']);


  	//assert the slug equals something 


  	$this->assertEquals('some-new-title',$post->slug);


  	//post to create a post later 
  	//now lets create a post with the same title 

  	$post2 = create('App\Post',['title' => 'Some New Title']);

  	//assert the new slug contains the id 
  	$this->assertEquals("some-new-title-{$post2->id}",$post2->slug);

 
  }


  /** @test */
    function a_thread_with_a_title_that_ends_numeric_should_generate_proper_slug(){


        $this->signIn();


        $post = create('App\Post',['title' => 'Some Title 24']); 

       // $thread = $this->postJson(route('threads'),$thread->toArray())->json();

        //create another post with same title 
        $post2 = create('App\Post',['title' => 'Some Title 24']);

        $this->assertEquals("some-title-24-{$post2['id']}",$post2['slug']);
    }

    /** @test */ 

    public function a_post_requires_a_title()
    {


      $this->publishPost(['title' => null])
        ->assertSessionHasErrors('title');
    }

    /** @test */ 
    public function a_post_requires_content(){

      $this->publishPost(['content' => null])
        ->assertSessionHasErrors('content');
    }

    /** @test */ 
    function a_post_requires_category_id(){


      $this->publishPost(['category_id' => null])
        ->assertSessionHasErrors('category_id');
    }

    /** @test */ 
    function authenticated_users_can_create_new_posts(){

      $this->signIn();

      $post = make('App\Post'); 


      $response = $this->post('/posts',$post->toArray());

       $this->get($response->headers->get('location'))
          ->assertSee($post->title);


     $this->assertDatabaseHas('posts',['title' => $post->title]);

    }
    public function publishPost($overrides = []){

      $this->disableExceptionHandling();

      $this->signIn();

      $post = make('App\Post',$overrides);


      //return response
      return  $this->post('/posts',$post->toArray());

    }


    /** @test*/
  public function unauthorized_user_cannot_delete_post(){

    $this->disableExceptionHandling();
    $post = create('App\Post'); 


    $this->get('/post/delete/' . $post->id)
      ->assertRedirect('login');


    $this->signIn();


    $this->get('/post/delete/' . $post->id)
     ->assertStatus(403);


  }



    /** @test */ 
  public function an_authorized_user_can_delete_post(){

    $this->signIn();

    $post = create('App\Post',['user_id' => auth()->id()]); 


    $comment = create('App\Comment',['commentable_id' => $post->id,'commentable_type' => 'App\Post']);
  
  // $this->delete($post->path());
    $this->json('get','/post/delete/'.$post->id)
      ->assertStatus(204);

   $this->assertNotNull($post->fresh()->deleted_at);

   // $this->assertDatabaseMissing('comments',['id' => $comment->id]);

  }
}
