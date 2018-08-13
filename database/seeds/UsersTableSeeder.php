<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User')->create([

        	'name' => 'Mahmoud Abdulhadi',
        	'username' => 'mahmoud_hadi',
        	'email'=> 'mahmoud.hadi93@gmail.com',
        	'gender' => 'male',
            'admin' => true


        ]);

         factory('App\User')->create([
            'name'=> 'Abd Saado', 
            'username' => 'abd_saado',
            'email'=> 'abd.saado@gmail.com',
             'gender' => 'male',
             'admin' => true
            ]);
    

    factory('App\User')->create([

        'name' => 'Amjad Sidawi',
        'username' => 'amjad_sidawi',
        'email' =>'amjad.sidawi@gmail.com',
        'gender' => 'male'
       ]);
    }
}
