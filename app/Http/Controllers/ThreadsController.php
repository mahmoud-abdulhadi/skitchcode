<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread ; 

use App\Channel ; 

use App\Filters\ThreadFilters ; 


use App\Trends\TrendingThreads;

use App\Tag ; 

class ThreadsController extends Controller
{


    public function __construct(){


        $this->middleware('auth')->except(['index','show']);
    }



    public function getThreads(Channel $channel,ThreadFilters $filters){

        $threads = Thread::latest()->filter($filters) ; 


       

        if($channel->exists){

            $threads = $threads->where('channel_id',$channel->id); 
        }

        

        return $threads->get();

    }

    public function index(Channel $channel,ThreadFilters $filters,TrendingThreads $trending){

    	$threads = $this->getThreads($channel,$filters);


        //good for testing and APIs 
        if(request()->wantsJson()){


            return $threads ;
        }
        
        return view('threads.index',[
            'threads' => $threads ,
            'trends' => $trending->get()
        ]);
    }


    public function show(Channel $channel , Thread $thread,TrendingThreads $trending)
    {


        //each time thread is read it is push to Trending databse 

        $trending->push($thread);

        $thread->increment('views');
        
    	return view('threads.show',compact('channel','thread'));

    }


    public function create()
    {
        $channels =Channel::all();

        $tags = Tag::all();
            
        return view('threads.create')->with('channels', $channels)->with('tags',$tags);
    }


    public function store(Request $request)
    {


        //create a thread 

        $this->validate($request,[

            'title' => 'required|spamfree',
            'body' => 'required|spamfree',
            'channel_id' => 'required|exists:channels,id'

        ]);



        $thread = Thread::create([
            'title' => $request->title,

            'body' => $request->body,
            'channel_id' => $request->channel_id,
            'user_id' => auth()->id(),


        ]);

        //Good for testing and APIs 
        if(request()->wantsJson()){

            return response($thread,201);
        }


        //redirect to thread page 

        return redirect($thread->path())
                ->with('flash','Your Thread has been published!');
    }

    public function edit(Channel $channel ,Thread $thread){

        $this->authorize('update',$thread);

        $channels = Channel::all();

        $tags = Tag::all();


        
        return view('threads.edit',compact('thread','channels','tags'));



    }


    public function destroy(Channel $channel , Thread $thread)
    {

        $this->authorize('delete',$thread);
        $thread->delete();

        if(request()->wantsJson()){

            return response([],204);
        }


        return redirect('/threads')
                    ->with('flash','Thread Deleted Successfully');
    }


    public function update(Channel $channel ,Thread $thread){

        //authorization 
        $this->authorize('update',$thread);
        //validation 

        $this->validate(request(),[


            'title' => 'required' ,
            'body' =>  'required'

        ]);

        //update 

        $channel_id = request()->has('channel_id') ? : $channel->id; 
        $thread->update([
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => $channel_id

        ]);

        return redirect($thread->path());
    }
}
