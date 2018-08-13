<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadSkitchesTest extends TestCase
{
    
    use DatabaseMigrations;


    protected $skitch ; 

    public function setUp(){


        parent::setUp(); 


      
        $this->skitch = create('App\Skitch');
    }

    /** @test */ 
    public function a_user_can_view_all_skitches(){

    	$response = $this->get('/skitches');

    	$response->assertStatus(200)
    		->assertSee($this->skitch->title);
    		
    }	

    /** @test */
    public function a_user_can_view_single_skitch(){

        
        $this->get($this->skitch->path())
            ->assertSee($this->skitch->title)
            ->assertStatus(200);
    }

    /** @test */ 
    function it_records_new_view_each_time_a_skitch_is_read(){


        $skitch = create('App\Skitch');

        $this->assertSame(0,$skitch->views);


        $this->call('GET',$skitch->path());


        $this->assertEquals(1,$skitch->fresh()->views);


    }


     /** @test */
    public function a_user_can_filter_skitches_by_any_username(){


        //signIn A new User 

        $this->signIn(create('App\User',['username' => 'mahmoud.hadi']));


        //create a skitch by that user

        $skitchByUser = create('App\Skitch',['user_id' => auth()->id()]); 

        //create a skitch not by that user 
        $skitchNotByUser = create('App\Skitch');


        //when hitting endpoint fetch the threads created by that user not by else users

       $this->get('/skitches/' . auth()->user()->username)
            ->assertSee($skitchByUser->title) 

           ->assertDontSee($skitchNotByUser->title);


    }


     /** @test */ 

    function a_user_can_filter_skitches_by_tags(){

         //we create a Tag 

        $tag = create('App\Tag');



        //create a skitch and attach tag to it  

        $skitchWithTag = create('App\Skitch');

        $skitchWithTag->addTag($tag);


        //create a thread not attached with that tag 

        $skitchWithoutTag = create('App\Skitch');


        //when we hit the endpoint of filtering 

        $this->get('/skitches/tags/'. $tag->slug)

        //We see the threads that attached to the tag  
            ->assertSee($skitchWithTag->title)

        //and doesn't see the threads that doesn't attached to the tag 
            ->assertDontSee($skitchWithoutTag->title);
    }


    /** @test */ 
    function a_user_can_fetch_skitch_tags(){

        //createa skitch 
        $skitch = create('App\Skitch');


        //count of skitch tags is 0 

        $this->assertCount(0,$skitch->tags);

        //create two tags 

        $tag1 = create('App\Tag');

        $tag2 = create('App\Tag');

        //attach those tags to skitches 
        $skitch->addTag($tag1);

        $skitch->addTag($tag2);

        $this->assertCount(2,$skitch->fresh()->tags);


        //fetch the skitch tags json
       $results = $this->getJson($skitch->path(). '/tags')->json();


        //count of skitch tags should be 2 

       $this->assertCount(2,$results);


    }
}
