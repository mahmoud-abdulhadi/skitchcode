<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateSkitchesTest extends TestCase
{
   use DatabaseMigrations ; 


   /** @test */ 
   function unauthorized_users_cannot_update_skitches()
   {
   		$this->disableExceptionHandling();

   		$skitch = create('App\Skitch');



   		$this->put('/skitches/' . $skitch->id , [])
   			->assertRedirect('login');


   		$this->signIn();

   		$this->putJson('/skitches/' . $skitch->id , [])
   			->assertStatus(403);

   }

   /** @test */ 
   function authorized_user_can_update_the_skitch()
   {

   		$this->signIn();

   		$skitch = create('App\Skitch',['user_id' => auth()->id()]);


   		$this->putJson('/skitches/' . $skitch->id , [
   			'title' => 'Some New Title', 
   			'description' => 'New Description' , 
   			'code' => json_encode([
     			'html' => '<h1 id="title">Changed Code</h1>', 
     			'css' => 'h1{color:red;text-align:center}',
     			'js' => 'var x = 2; const title=document.querySelector(\'#h1\');'
     			])

   		])->assertStatus(200);

   		$this->assertEquals('Some New Title', $skitch->fresh()->title);
   		$this->assertEquals('New Description', $skitch->fresh()->description);
   		$html = '<h1 id="title">Changed Code</h1>' ; 

   		$this->assertEquals($html,json_decode($skitch->fresh()->code)->html);



   }
}
