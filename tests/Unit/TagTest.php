<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
   use DatabaseMigrations ; 


   /** @test */ 
   function a_tag_can_belongs_to_many_posts(){

   	$tag = create('App\Tag');

   	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$tag->posts);

   }

    /** @test */ 
   function a_tag_can_belongs_to_many_skitches(){

   	$tag = create('App\Tag');

   	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$tag->skitches);

   }



    /** @test */ 
   function a_tag_can_belongs_to_many_threads(){

   	$tag = create('App\Tag');

   	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$tag->threads);

   }

    /** @test */ 
   function a_tag_can_belongs_to_many_workspaces(){

   	$tag = create('App\Tag');

   	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$tag->workspaces);

   }
}
