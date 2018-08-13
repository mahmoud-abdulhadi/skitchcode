<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon ; 

use App\Thread ; 

class Comment extends Model implements Commentable , Likeable,Recordable
{
    use CommentableTrait, LikeableTrait,RecordsActivityTrait; 


    protected static function boot()
    {


        parent::boot();

        static::deleting(function($comment){


            $comment->comments->each->delete();
        });

        static::deleted(function($comment){

            if($comment->commentable instanceof Thread){

                if($comment->isBest){
                        $comment->commentable->update(['best_reply_id' => null]);

                }
            }
        });
    }


	protected $fillable = ['body','user_id'];

    protected $appends = ['isBest'] ; 


	public function commentable(){

		return $this->morphTo();
	}


    public function author(){


    	return $this->belongsTo('App\User','user_id');
    }

    public function path()
    {

    	return $this->commentable->path() . '#comment-' . $this->id ; 
    }

     public function wasJustPublished(){


        return $this->created_at->gt(Carbon::now()->subMinute()); 
    }

    public function getIsBestAttribute()
    {

        if($this->commentable instanceof Thread){

            return  $this->commentable->best_reply_id == $this->id ; 
        }
    }


     public function mentionedUsers()
    {


        preg_match_all('/@([\w\-\.]+)/',$this->body, $matches);


        return $matches[1];
    }

    //wrap mentioned users in the body with anchor tags 

    public function setBodyAttribute($body){

        $this->attributes['body'] = preg_replace('/@([\w\-\.]+)/', '<a href="/profiles/$1">$0</a>',$body);

    }
}
