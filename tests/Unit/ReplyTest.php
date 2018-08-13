<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Carbon\Carbon ; 

class ReplyTest extends TestCase
{

	use DatabaseMigrations ; 

   protected $comment ; 
   public function setUp(){

			parent::setUp();


			//Create A Reply to used by methods 
			

			//using helpers 

			$this->comment = create('App\Comment');
		}

	/** @test */ 
	public function a_reply_has_comments(){

		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->comment->comments);
	}

	/** @test */
	public function a_reply_belongs_to_an_author(){

		$this->assertInstanceOf('App\User',$this->comment->author);
	}

	/** @test */ 
	public function a_comment_belongs_to_a_commentable(){

		$this->assertInstanceOf('App\Commentable',$this->comment->commentable);
	}

	/** @test */ 
	public function a_comment_generate_string_path()
	{


		$comment = create('App\Comment',['commentable_id' => create('App\Post')->id,'commentable_type' => 'App\Post']);

		$path = $comment->commentable->path() . '#comment-' . $comment->id ; 

		$this->assertEquals($path,$comment->path());
	}



	 /** @test */ 
    public function it_know_if_it_was_just_published()
    {


        $comment = create('App\Comment');

        $this->assertTrue($comment->wasJustPublished());


        $comment->created_at = Carbon::now()->subHour();

        $this->assertFalse($comment->wasJustPublished());


    }


    /** @test */ 
    function it_knows_if_it_is_the_best_reply(){

        $comment = create('App\Comment');

        $this->assertFalse($comment->isBest);

        $comment->commentable->update(['best_reply_id' => $comment->id]);


        $this->assertTrue($comment->fresh()->isBest);



    }


        /** @test */ 
    	function it_can_detect_mentioned_users()
    	{

            $comment = create('App\Comment',[
                'body' => '@john_doe says Hello to @Jane-Doe'
             ]);

          

        	$this->assertEquals(['john_doe','Jane-Doe'],$comment->mentionedUsers());
    }

     /** @test */
    function it_wraps_mentioned_users_in_body_with_anchor_tags(){

        $comment = new \App\Comment([

            'body' => 'Hello,@Jane-Doe!!.'
        ]);

        $this->assertEquals('Hello,<a href="/profiles/Jane-Doe">@Jane-Doe</a>!!.',$comment->body);
    }
}
