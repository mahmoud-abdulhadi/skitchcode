<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Storage ;

use Illuminate\Http\UploadedFile ; 

class UpdatePostsTest extends TestCase
{
    

    use DatabaseMigrations ; 



    public function setUp()
    {


    	parent::setUp();

    	
    }


    /** @test */ 
    function unauthorized_users_can_not_update_posts()
    {

    	$this->disableExceptionHandling();
    	$this->signIn();


    	$post  = create('App\Post');


    	$this->patch($post->path(),[])
    		->assertStatus(403);

    }

    /** @test */ 
    function a_post_can_be_updated_by_its_author()
    {


    
    	$this->signIn();
    	$post = create('App\Post',['user_id' => auth()->id()]);

    	//update
    	$this->patch($post->path(),[
    		'title' => 'Changed Title', 
    		'content' => 'new Content'
    	]);


    	$this->assertEquals('Changed Title', $post->fresh()->title);
    	$this->assertEquals('new Content',$post->fresh()->content);


    }

    //validation tests 
    /** @test */ 
    function a_post_requires_a_title_when_updating()
    {
    	$this->disableExceptionHandling();
    	$this->signIn();

    	$post = create('App\Post',['user_id' => auth()->id()]) ; 

    	$this->patch($post->path(),[

    		'body' => 'Some New Body'
    	])->assertSessionHasErrors('title');



    }

    /** @test */ 
    function a_post_requires_a_content_to_be_updated()
    {

    	$this->disableExceptionHandling();
    	$this->signIn();

    	$post = create('App\Post',['user_id' => auth()->id()]) ; 

    	$this->patch($post->path(),[

    		'title' => 'Brand New Title'
    	])->assertSessionHasErrors('content');

    }

   


    /** @test */ 
    function a_user_can_update_category_of_post()
    {


        $this->disableExceptionHandling()->signIn();

        $category1 = create('App\Category');

        $category2 = create('App\Category');

        $post = create('App\Post',['user_id' => auth()->id(),'category_id' => $category1->id]);


        

        $this->patch($post->path(),[
            'title' => 'Some New Title' , 
            'content' => 'Some new Body',
            'category_id' => $category2->id

        ]);

        $this->assertEquals($category2->id,$post->fresh()->category_id);

    }


    /** @test */ 
    function valid_category_id_should_given()
    {
        $this->disableExceptionHandling()->signIn();

        $category1 = create('App\Category');

        $category2 = create('App\Category');

        $post = create('App\Post',['user_id' => auth()->id(),'category_id' => $category1->id]);


        

        $this->patch($post->path(),[
            'title' => 'Some New Title' , 
            'content' => 'Some new Body',
            'category_id' => 4

        ])->assertSessionHasErrors('category_id');


    }
}
