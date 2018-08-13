<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateCategoryTest extends TestCase
{
    use DatabaseMigrations ; 


    /** @test */ 
    public function a_category_requires_a_title(){

    	$this->disableExceptionHandling();

    	$category = make('App\Category',['title' => null]);

    	$this->post('/categories',$category->toArray())
    		->assertSessionHasErrors('title');


    }


    /** @test */ 
    public function an_authenticated_user_can_create_category()
    {
    	$this->signIn();

    	$category = make('App\Category');

    	$this->post('/categories',$category->toArray()) ; 

    	$this->assertDatabaseHas('categories',['title' => $category->title]);




    }
}
