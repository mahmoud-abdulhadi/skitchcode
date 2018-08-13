<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateWorkspacesTest extends TestCase
{
   use DatabaseMigrations ; 

   /** @test */ 
   function unauthorized_users_cannot_update_workspaces()
   {
   		$this->disableExceptionHandling();

   		$workspace = create('App\Workspace');



   		$this->put($workspace->path() , [])
   			->assertRedirect('login');


   		$this->signIn();

   		$this->putJson($workspace->path() , [])
   			->assertStatus(403);

   }

    /** @test */ 
   function workspace_owner_can_update_the_workspace()
   {

         $this->signIn();

         $workspace = create('App\Workspace',['user_id' => auth()->id()]);


         $this->putJson($workspace->path(), [
            'title' => 'Some New Title', 
            'description' => 'New Description' , 
            'items' => json_encode([
            [
                'name' => 'css',
                 'isFolder' => true,
                 'children' => [
                    [
                    'name'=>'style.css',
                    'isFolder' => false,
                    'content' => 'h1{color:red;text-align:center}'

                    ],
                    [
                     'name' => 'code.css',
                     'isFolder' => false , 
                     'content' => 'body {padding: 5px}'
                    ],
                    [
                        'name'=>'app.css',
                        'isFolder' => false,
                        'content' => 'h1{color:red}'
                    ]
                 ],


            ],
            [
                'name' => 'scripts',
                'isFolder' => true,
                'children' => [[
                        'name' => 'app.js',
                        'isFolder' => false,
                        'content' => "var x = 2; const title=document.querySelector('#h1');"]

                ]

            ],
            [
                'name' => 'index.html',
                'isFolder' => false,
                'content' => '<h1>Hello World</h1>'
            ]

        ])
         ])->assertStatus(200);

        $this->assertEquals('Some New Title', $workspace->fresh()->title);
        $this->assertEquals('New Description', $workspace->fresh()->description);
        

            }


/** @test */ 
function workspaace_participants_can_update_it()
{
  $this->disableExceptionHandling();
  
  $workspace = create('App\Workspace');

  $this->signIn();

  

  $workspace->add(auth()->user());


  $this->putJson($workspace->path(),[
    'title' => 'Some New Title', 
            'description' => 'New Description' , 
            'items' => json_encode([

                'name' => 'index.html',
                'isFolder' => false 
            ])


          ])->assertStatus(200);





}

}
