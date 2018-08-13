<?php 



namespace App ; 



trait TaggableTrait {



	public function tags(){



		return $this->morphToMany('App\Tag','taggable');
	}

	public function addTag($tag){


        $this->tags()->attach($tag->id);
    }

    public function removeTag($tag){


    	$this->tags()->detach($tag->id);
    }



}