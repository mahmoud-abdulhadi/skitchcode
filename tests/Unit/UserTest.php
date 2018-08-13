<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations ;
    protected $user ;  

    protected function setup()
    {



    	parent::setUp();

    	$this->user = create('App\User');
    }


    /** @test */ 
    public function a_user_can_have_many_threads(){


    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->threads);
    }

    /** @test */ 
    public function a_user_can_many_skitches(){

    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->skitches);
    }

    

     /** @test */ 
    public function a_user_can_many_workspaces(){

    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->workspaces);
    }

    /** @test */ 
    public function a_user_can_have_many_posts(){


    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->posts);
    }

    /** @test */ 
    public function a_user_can_have_many_comments(){

    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->comments);
    }

    use DatabaseMigrations ; 

    /** @test */
    function a_user_can_fetch_their_most_recent_reply()
    {

        $user = create('App\User');

        $comment = create('App\Comment', ['user_id' => $user->id]);



        $this->assertEquals($comment->id , $user->lastComment->id);


    }

    /** @test */ 
    function a_user_can_be_part_of_many_projects(){


        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->projects);
    }

    /** @test */
    function it_can_fetches_the_forks(){


        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->user->forks);
    }

   
    
}
