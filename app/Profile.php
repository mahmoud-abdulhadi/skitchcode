<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['city','country','bio','user_id'];


    /**
     * A profile belongs to One User 
     */
    public function user(){


    	return $this->belongsTo('App\User');
    }
}
