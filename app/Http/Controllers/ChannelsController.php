<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Channel ; 

class ChannelsController extends Controller
{
    

    public function index(){

    	$channels = Channel::latest()->get();

    

    	if(request()->expectsJson()){

    		return $channels ; 
    	}

    	return view('admin.channels.index', compact('channels'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required'

        ]);

        $channel = Channel::create([

            'title' => request('title')
        ]);

        return $channel ; 

        
    }

    public function destroy(Channel $channel){

    	foreach($channel->threads as $thread){

    		$thread->forceDelete();


    	}

    	$channel->delete();

    	if(request()->wantsJson()){
    		return response([],204);
    	}
    }

    public function update(Channel $channel)
    {


    	$channel->title = request('title'); 


    	$channel->save();

    	return response([],200); //OK 

    }

}
