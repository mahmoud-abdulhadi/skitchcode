<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'gender' => function(){

                $sex = ['male','female'] ; 

                return $sex[array_rand($sex)] ; 
        },
        'username' => $faker->unique()->userName, 
        'email' => $faker->unique()->safeEmail,
    
        //'avatar'=> $faker->imageUrl($width=400, $height=200, 'people') ,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class,'administrator',function(){


    return [

        'admin' => true

    ];


});



$factory->define(App\Skitch::class, function (Faker\Generator $faker) {
   

    return [
    	'title' => $faker->sentence,
    	'description' => $faker->paragraph,
    	'user_id' => function(){

    		return factory('App\User')->create()->id ; 
    	},
     	'code' => json_encode([
     		'html' => '<h1 id="title">Hello World</h1>', 
     		'css' => 'h1{color:red;text-align:center}',
     		'js' => 'var x = 2; const title=document.querySelector(\'#h1\');'
     	]),
        'views' => 0  
    ];
});




$factory->define(App\Workspace::class, function (Faker\Generator $faker) {
   
    

    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'items' => json_encode([
            [
                'name' => 'styles',
                 'isFolder' => true,
                 'children' => [
                    [
                    'name'=>'style.css',
                    'isFolder' => false,
                    'content' => 'h1{color:red;text-align:center}'

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

        ]),
        'user_id' => function(){

            return factory('App\User')->create()->id ; 
        },
        'views' => 0 
       
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
   

    return [
        'title' => $faker->sentence($nb=3),
        'slug' => ''

    ];
});


$factory->define(App\Post::class, function (Faker\Generator $faker) {
   

    return [
        'title' => $faker->sentence($nbWords=5),
        'content' => $faker->paragraph,
        'category_id'=> function(){

                return factory('App\Category')->create()->id ; 
        },
        'cover'=> $faker->imageUrl($width = 800, $height = 600,'technics'),
        'user_id'=> function(){

            return factory('App\User')->create()->id ; 
        } ,
        'views' => 0  
    ];
});


$factory->define(App\Thread::class, function (Faker\Generator $faker) {


    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph, 
        'user_id' => function(){

            return factory('App\User')->create()->id ; 
        },
        'channel_id' => function(){


            return factory('App\Channel')->create()->id ; 
        },
        'views' => 0 
    ];
});


$factory->define(App\Channel::class, function (Faker\Generator $faker) {


    return [

        'title' => $faker->sentence($nb=2),
        'slug' => ''   
       
       
    ];
});


$factory->define(App\Tag::class, function (Faker\Generator $faker) {

     $name = $faker->unique()->word ; 
    return [

        'name' => $name,
        'slug' => str_slug($name)
       
       
    ];
});




$factory->define(App\Comment::class, function (Faker\Generator $faker) {


    return [
       'body' => $faker->paragraph($nbSentences=2),
       'user_id' => function(){


            return factory('App\User')->create()->id ; 
       },
       'commentable_id' => function(){

              

                return factory('App\Thread')->create()->id ; 

       },
       'commentable_type' => function(){

            return 'App\Thread' ; 
       }
      
    ];
});


$factory->define(App\Profile::class, function (Faker\Generator $faker) {
   

    return [
            'city' => $faker->city,
            'country' => $faker->country,
            'bio' => $faker->paragraph($nbSentences=1),
            'user_id' => function(){

                return factory('App\User')->create()->id ; 
            } 
    ];
});


$factory->define(Illuminate\Notifications\DatabaseNotification::class,function(Faker\Generator $faker){


    return [


            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),

            'type' => 'App\Notifications\ThreadWasUpdated',
            'notifiable_id' => function(){


                return auth()->id() ?: factory('App\User')->create()->id ; 
            },
            'notifiable_type' => 'App\User',
            'data' => ['foo' => 'New Notification']


    ]; 


});

