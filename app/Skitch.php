<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\SkitchFilters ;

use Laravel\Scout\Searchable ;  

class Skitch extends Model implements Commentable,Likeable,Taggable,Recordable
{
    use CommentableTrait,Searchable,LikeableTrait,TaggableTrait,RecordsActivityTrait ; 
    
    protected $guarded = []; 

    protected $casts = [
    	'code' => 'array',
        'is_forked' => 'boolean'

    ]; 

    public static function boot(){

        parent::boot(); 

        

        /* Delete All Comments when deleting A Skitch */
        static::deleting(function($skitch){



            $skitch->comments->each->delete();

            $skitch->forks->each->update(['forkable_id' => null]);
        });
    }

    public function getCodeAttribute($value){

    	return json_decode($value);
    }

    public function path(){


        return '/skitches/' . $this->author->username . '/' . $this->id ; 
    }

    public function author(){


    	return $this->belongsTo('App\User','user_id');
    }

    

     public function scopeFilter($query,SkitchFilters $filters){

        return $filters->apply($query);
    }


    public function forks(){


        return $this->hasMany('App\Skitch','forkable_id');
    }

    public function forkable(){

        return  $this->belongsTo('App\Skitch','forkable_id');
    }

    public function fork($user = null){

        $user_id = $user ? $user->id : auth()->id() ; 

        
        return $this->forks()->create([
            'user_id' => $user_id,
            'is_forked' => true,
            'title' => $this->title,
            'description' => $this->description,
            'code' => $this->code
        ]);
    }

}
