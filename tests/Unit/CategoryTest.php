<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
     use DatabaseMigrations ; 

   protected $category ; 

   public function setUp(){

			parent::setUp();


			//Create A post to used by methods 
			 

			//using helpers 

			$this->category = create('App\Category');
		}

		/** @test */ 

		public function a_category_has_many_posts()
		{

			$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->category->posts);
		}


		/** @test */ 
		public function a_category_has_slug(){


			$this->assertEquals(str_slug($this->category->title),$this->category->slug); 
		}

		/** @test*/
		public function category_can_generate_string_path()
		{


			$category = create('App\Category');
			$path = '/posts/' . $category->slug ; 


			$this->assertEquals($path,$category->path);

		}
}
