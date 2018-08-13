<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $guarded = [];

     protected static function boot(){

        parent::boot();



        static::created(function($tag){


            $tag->update(['slug' => $tag->name]); 

        });

      


    }
    public function getRouteKeyName(){


        return 'slug' ; 
    }

    public function posts(){

    	return $this->morphedByMany('App\Post','taggable')
            ->latest();
    }


     public function skitches(){

    	return $this->morphedByMany('App\Skitch','taggable')
            ->latest();
    }

     public function threads(){

    	return $this->morphedByMany('App\Thread','taggable')
                    ->latest();
    }
     public function workspaces(){

    	return $this->morphedByMany('App\Workspace','taggable')
            ->latest();
    }

    public function setSlugAttribute($value){

        $slug = str_slug($value);


        if(static::whereSlug($slug)->exists()){

            $slug = "{$slug}-" . $this->id ; 

        }



        $this->attributes['slug'] = $slug ; 

    }
}
