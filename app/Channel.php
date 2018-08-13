<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    
    protected $appends = ['path'];

    protected $guarded = []; 


	protected static function boot()
	{

		parent::boot();

		static::creating(function($channel){

			$channel->slug = str_slug($channel->title);
		});


		static::addGlobalScope('threads_count',function($channel){


			$channel->withCount('threads'); 
		});

	}

	public function getRouteKeyName()
	{

		return 'slug';
	}
    public function threads(){

    	return $this->hasMany('App\Thread');
    }

    public function getPathAttribute(){

    	return '/threads/' . $this->slug ; 
    }
}
