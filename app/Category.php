<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

	protected static function boot(){


		parent::boot();

		static::creating(function($category){

			$category->slug = str_slug($category->title);

		});

        static::addGlobalScope('posts_count',function($category){


            $category->withCount('posts');
        });
	}
    

    protected $appends = ['path'];



    public function getRouteKeyName(){



        return 'slug' ;
    }
    /**
    *Category has many posts 
    */
    public function posts(){

    	return $this->hasMany('App\Post');
    }

    public function getPathAttribute(){


        return '/posts/' . $this->slug ; 
    }
    

    
}
