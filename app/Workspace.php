<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\WorkspaceFilters ; 

use Laravel\Scout\Searchable ; 

use App\Events\WorkspaceHasNewParticipant ; 

use App\Notifications\ParticipantWasAdded ; 

use App\User ; 

use Auth ; 

class Workspace extends Model implements Commentable,Taggable,Recordable
{

    use CommentableTrait,TaggableTrait,RecordsActivityTrait,Searchable ; 

    
    protected $guarded = []; 


    public static function boot(){


        parent::boot();

        static::updating(function($workspace){


            $workspace->recordChange();
        });


        /* Delete All Comments when deleting A Workspace */
        static::deleting(function($workspace){

            $workspace->comments->each->delete();

        });
    }


    public function path(){


        return '/workspaces/' . $this->author->username . '/' . $this->id ; 
    }
    public function author(){


    	return $this->belongsTo('App\User','user_id');
    }


    /** Has Many Participants */ 
    public function participants(){


        return $this->belongsToMany('App\User','participants')
            ->withTimestamps();
    }

    //Add Participant to workspace 
    public function add($user){
        
        $this->participants()->attach($user->id);

        event(new WorkspaceHasNewParticipant($this,$user));

    }

    //remove participants from workspace 

    public function remove($user){


        $this->participants()->detach($user->id);
    }

   
    public function changes(){

        //second parameter the name of the table 
        //jsut overide it 
        return $this->belongsToMany(User::class,'changes')
               ->withTimestamps()
               ->withPivot(['before','after','id'])
                ->latest('pivot_updated_at');
    }


    /** determine if speciif user is participant in the workspace */ 
    public function isParticipant($user = null){
        

        $user = $user ?: auth()->user();

        if(! $user){

            return false ; 
        } 

        return $this->participants()
            ->where('user_id',$user->id)
            ->exists();

    }

     public function scopeFilter($query,WorkspaceFilters $filters){

        return $filters->apply($query);
    }

    public function notifyParticipants($user){

            $workspace = $this ; 

            $this->fresh()
                ->participants
                ->each(function($participant) use($workspace,$user){



                    $userParticipant = User::where('username',$participant->username)->firstOrFail();

                  // dd($userParticipant);

                    $userParticipant->notify(new ParticipantWasAdded($workspace,$user));

                 });

    }



    public function recordChange($userId = null,$diff = null){

         $userId = $userId ?: Auth::id(); 

         $diff = $diff ?: $this->getDiff();

       return   $this->changes()->attach($userId,$diff);
      }

      protected function getDiff(){

            $changed = $this->getDirty();

            $before =  json_encode(array_intersect_key($this->fresh()->toArray(), $changed)) ; 

            $after = json_encode($changed); 


            return compact('before','after');

      }




   
}
