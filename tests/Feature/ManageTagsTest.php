<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageTagsTest extends TestCase
{
    use DatabaseMigrations ; 

    /** @test */ 
    function a_user_can_fetch_all_tags(){


       $this->signIn(factory('App\User')->states('administrator')->create());
       
    	//create tags 
    	$tag = create('App\Tag');


    	//fetch tags 
    	$results = $this->getJson('/tags')->json();

    

    	//status OK 

    	
    	$this->assertCount(1,$results);
    	

    	//count of results should be 1 
    	$this->assertEquals($tag->id,$results[0]['id']);
    }

    /** @test */ 
    function admin_can_create_a_tag(){


        $this->signIn(factory('App\User')->states('administrator')->create());

        $tag = make('App\Tag',['name' => 'HTML','slug' =>'html']) ; 

        $this->postJson('/tags',$tag->toArray());


        $this->assertDatabaseHas('tags',['slug' => $tag->slug]);


    }

    /** @test */ 
    function admin_can_remove_a_tag(){

        //signIn as Admin 
        $this->signIn(factory('App\User')->states('administrator')->create());

        //create a tag 

        $tag = create('App\Tag');

        //assert count 1 of tags

        $this->assertCount(1,\App\Tag::all());


        //hit the endpint to delete a tag 

        $this->deleteJson('/tags/' . $tag->slug);


        //assert database missing this tag 

        $this->assertDatabaseMissing('tags',['id' => $tag->id]);

    }

    /** @test */
    function unauthorized_user_cannot_create_a_tag(){
        $this->disableExceptionHandling();

        $this->signIn();


        $this->postJson('/tags',[])
            ->assertStatus(403);


    }
   

    /** @test */
    function unauthorized_user_cannot_delete_a_tag(){
        $this->disableExceptionHandling();
        
        $this->signIn();

        $tag = create('App\Tag');


        $this->deleteJson('/tags/' . $tag->slug)
            ->assertStatus(403);


    }

    /** @test */ 
    function deleting_a_tag_will_detach_its_models(){

        //create a tag 

        $tag = create('App\Tag');

        //create a thread 

        $thread = create('App\Thread');

        //attach thread to that tag 

        $thread->addTag($tag);


        //count of thread tags 1

        $this->assertCount(1,$thread->tags); 
        //create a post 

        $post = create('App\Post');

        //attach a post to that tag

        $post->addTag($tag); 




        //count of post tags is 1
        $this->assertCount(1,$post->tags); 

        //create a skitch 
        $skitch = create('App\Skitch');

        //attach a skitch to that tag 

        $skitch->addTag($tag);

        //count of skitch tags is 1

        $this->assertCount(1,$skitch->tags); 

        //create a workspace

        $workspace = create('App\Workspace');

        //attach a workspace to that tag 

        $workspace->addTag($tag);


        //count of workspace tags 1

        $this->assertCount(1,$workspace->tags); 
        //signIn as admin 

        $this->signIn(factory('App\User')->states('administrator')->create());


        //hit the ednpoint to delete that tag 

        $this->deleteJson('/tags/' . $tag->slug);

        //count of of post tags 0 

  

        $this->assertCount(0,$post->fresh()->tags);

        //count of workspace tags 0 

        $this->assertCount(0,$workspace->fresh()->tags);

        //count of threads tags 0 

        $this->assertCount(0,$thread->fresh()->tags);

        //count of skitch tags 0 
        $this->assertCount(0,$skitch->fresh()->tags);

    }
}
