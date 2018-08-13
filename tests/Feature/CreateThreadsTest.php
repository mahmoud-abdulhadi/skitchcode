<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations ;


    /** @test */ 
    function a_guest_may_not_create_threads()
    {

      $this->disableExceptionHandling();

       $this->get('/threads/create')
        ->assertRedirect('login');


    }

    /** @test */ 
    function a_thread_requires_a_title()
    {

        $this->publishThread(['title' => null])
          ->assertSessionHasErrors('title');



    }

    /** @test*/
    function a_thread_requires_a_body()
    {

        $this->publishThread(['body' => null])
          ->assertSessionHasErrors('body');

    }


    /** @test */ 
    function a_thread_requires_a_channel_id()
    {


      $this->publishThread(['channel_id' => null])
        ->assertSessionHasErrors('channel_id'); 
    }

     /** @test */ 
    function a_thread_requires_a_unique_slug()
    {


       $this->signIn();

       

       $thread =  create('App\Thread',['title' => 'Foo Title']);

        $this->assertEquals('foo-title',$thread->fresh()->slug);

      $thread = $this->postJson(route('thread.store'),$thread->toArray())->json();




      $this->assertEquals("foo-title-{$thread['id']}",$thread['slug']);

        

    }

    /** @test */
    function a_thread_with_a_title_that_ends_in_numeric_should_generate_proper_slug(){


        $this->signIn();


        $thread = create('App\Thread',['title' => 'Some Title 24']); 

        $thread = $this->postJson(route('thread.store'),$thread->toArray())->json();


        $this->assertEquals("some-title-24-{$thread['id']}",$thread['slug']);
    }

   

    /** @test */ 
    public function authenticated_user_can_create_new_threads()
    {

        $this->signIn();


        $thread = make('App\Thread');


        $response = $this->post('/threads',$thread->toArray());

       

        $this->get($response->headers->get('location'))
          ->assertSee($thread->title);


     $this->assertDatabaseHas('threads',['title' => $thread->title]);




    }

    /** @test */
    public function publishThread($overrides = [])
    {


      $this->disableExceptionHandling();

      $this->signIn();


      $thread = make('App\Thread',$overrides);

    

     return  $this->post('/threads',$thread->toArray());
    }

    /** @test*/
    function authenticated_user_can_delete_thread(){


      $this->signIn();


      $thread = create('App\Thread',['user_id' => auth()->id()]);

      $comment = create('App\Comment',['commentable_id' => $thread->id ,'commentable_type' => 'App\Thread']); 

      //$this->delete($thread->path());

      $this->json('delete',$thread->path())
        ->assertStatus(204);


      $this->assertDatabaseMissing('threads',['id' => $thread->id]);

      $this->assertDatabaseMissing('comments' ,['id' => $comment->id]);
    }

    /** @test*/
    function unauthenticated_user_may_not_delete_thread()
    {


      $this->disableExceptionHandling();

      $thread = create('App\Thread'); 

      $this->delete($thread->path())
        ->assertRedirect('login');

      $this->signIn();

      $this->delete($thread->path())
        ->assertStatus(403);
    }
}
