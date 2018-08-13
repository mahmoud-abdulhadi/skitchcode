<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChannelTest extends TestCase
{
    use DatabaseMigrations ; 

   protected $channel ; 

   public function setUp(){

			parent::setUp();


			//Create A post to used by methods 
			 

			//using helpers 

			$this->channel = create('App\Channel');
		}

		/** @test */
		public function a_channel_has_threads(){

			$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->channel->threads); 

		}

		/** @test */
		public function a_channel_has_a_slug(){

			$this->assertEquals(str_slug($this->channel->title),$this->channel->slug);
		}
}
