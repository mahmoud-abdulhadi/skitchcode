<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    protected $casts = [
        'admin' => 'boolean'
    ];

     public static function boot(){

        parent::boot(); 

        

        /* Delete All Comments when deleting A Skitch */
        static::deleting(function($user){



         $user->skitches->each->delete();
         $user->workspaces->each->delete();
         $user->posts->each->delete();
         $user->threads->each->delete();
        });
    }

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName(){

        return 'username' ;
    }

    public function skitches(){

        return $this->hasMany('App\Skitch');
    }

    public function workspaces(){

        return $this->hasMany('App\Workspace');
    }

    /**
     *User has many posts */
    public function posts(){

        return $this->hasMany('App\Post');
    }

    /**
    * User has many Threads
    */
    public function threads(){

        return $this->hasMany('App\Thread');
    }
    /**
     *
     */
    public function comments(){

        return $this->hasMany('App\Comment');
    }

    /**
    * Every User has One Profile 
    */
    public function profile(){

        return $this->hasOne('App\Profile');
    }


    public function subscriptions(){


        return $this->hasMany('App\ThreadSubscription');
    }

    //fetch the last reply of the user 
    public function lastComment()
    {

        return $this->hasOne(Comment::class)->latest();
    }

    public function projects(){


        return $this->belongsToMany('App\Workspace','participants')
            ->withTimeStamps()
            ->latest('pivot_created_at');
    }

    public function forks(){


        return $this->skitches()
                    ->where('is_forked',true)
                    ->latest();
    }


    /*
    *A User has many activities 
    */
    public function activities(){

        return $this->hasMany('App\Activity');
    }

    //determine if a user is admin 
    public function isAdmin(){

        return $this->admin ; 
    }


  
}
