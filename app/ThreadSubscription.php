<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use App\Notifications\ThreadWasUpdated; 

class ThreadSubscription extends Model
{
    protected $guarded = [] ; 



    public function user(){


    	return $this->belongsTo('App\User');

    }

    public function thread(){


    	return $this->belongsTo('App\Thread');
    }


    public function notify($comment){

    	$this->user->notify(new ThreadWasUpdated($this->thread,$comment));
    }
}
