<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\ThreadFilters ; 
use App\Comment ; 

use Laravel\Scout\Searchable ; 

class Thread extends Model implements Commentable,Likeable,Taggable,Recordable
{
    use CommentableTrait,Searchable,LikeableTrait,TaggableTrait,RecordsActivityTrait ; 

    protected $guarded = [];

    protected $with = ['channel'];
   

    protected $casts = [

        'locked' => 'boolean'
    ];

    protected static function boot(){

        parent::boot();



        static::created(function($thread){


            $thread->update(['slug' => $thread->title]); 

        });

        static::deleting(function($thread){


            $thread->comments->each->delete();
        });


    }



    public function path(){


        return '/threads/' . $this->channel->slug.'/' . $this->slug ;  
    }
    /**
    *	Thread Belongs to One User 
    */
    public function author(){

    	return $this->belongsTo('App\User','user_id');
    }

    /**
    * A Thread Belongs to a channel 
    */
    public function channel(){

    	return $this->belongsTo('App\Channel');
    }


    public function scopeFilter($query,ThreadFilters $filters){

        return $filters->apply($query);
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

   


    public function subscribe($userId = null){

            $this->subscriptions()->create([

                'user_id' => $userId?:auth()->id() 

            ]);


            return $this ; 
    }

    public function unsubscribe($userId = null){

        $this->subscriptions()
            ->where('user_id', $userId?:auth()->id())
            ->delete();

        return $this ; 
    }   

    public function subscriptions(){

        return $this->hasMany('App\ThreadSubscription');
    }

    public function getIsSubscribedToAttribute(){


        return $this->subscriptions()
                    ->where('user_id', auth()->id())
                    ->exists();
    }

    public function notifySubscribers($comment){

        $this->subscriptions
            ->where('user_id','!=',$comment->user_id)
            ->each
            ->notify($comment);

    }

    public function markBestReply(Comment $comment)
    {


        $this->update(['best_reply_id' => $comment->id]);
    }

    // lock a thread 

    public function lock(){

        $this->update(['locked' => true]);
    }



    //unlokc a thread 

    public function unlock(){

        $this->update(['locked' => false]);
    }
}
