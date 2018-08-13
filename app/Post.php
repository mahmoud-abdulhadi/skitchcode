<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes ; 	

use App\Filters\PostFilters ;

use Laravel\Scout\Searchable ;  

class Post extends Model implements Commentable,Likeable,Taggable,Recordable
{

    use CommentableTrait,Searchable,LikeableTrait,TaggableTrait,RecordsActivityTrait ; 

    
    use SoftDeletes	 ; 

    protected $with = ['category'];

    protected static function boot(){

        parent::boot();


        static::created(function($post){


            $post->update(['slug' => $post->title]);
        });


        static::deleting(function($post){


            $post->comments->each->delete();
        });

    }

    protected $fillable = ['title','slug','content','category_id','cover','user_id'];


    protected $dates = ['deleted_at'];

    /**
    *post Belongs to one Category 
    */
    public function category(){

    	return $this->belongsTo('App\Category');
    }

    /**
    *Post has a user 
    */
    public function author(){

    	return $this->belongsTo('App\User','user_id');
    }

    public function path()
    {


        return '/posts/' . $this->category->slug . '/' . $this->slug ; 
    }

    public function getRouteKeyName(){


        return 'slug';
    }


    public function setSlugAttribute($value){

        $slug = str_slug($value); 

        if(static::whereSlug($slug)->exists()){

            $slug = "{$slug}-" . $this->id ; 
        }

        $this->attributes['slug'] = $slug ; 

    }


    public function scopeFilter($query,PostFilters $filters){

        return $filters->apply($query);
    }

    
    
}
