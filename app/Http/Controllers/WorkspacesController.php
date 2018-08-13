<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User ; 

use App\Workspace ; 

use App\Filters\WorkspaceFilters ;

use Laravel\Scout\Searchable ; 

use File ; 
use Session ; 

class WorkspacesController extends Controller
{
    public function __construct()
    {



        $this->middleware('auth')->except(['show','index']);
    }



    public function getWorkspaces(User $user,WorkspaceFilters $filters){

        $workspaces = Workspace::latest()->filter($filters) ; 


        if($user->exists){

            $workspaces = $workspaces->where('user_id',$user->id); 
        }


        return $workspaces->get();

    }

	public function index(User $user,WorkspaceFilters $filters){


		$workspaces = $this->getWorkspaces($user, $filters);




		return view('projects.index',compact('workspaces'));


	}

	public function show(User $user,Workspace $workspace){

		//update the views 


		//update views 

		$workspace->increment('views');

		//pass items 

		

		return view('projects.show',compact('workspace','user'));
	}

    public function create(){


    	return view('projects.create');

    }


    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required|max:100|spamfree',
            'description' => 'spamfree'

        ]);

    	$items = request('items');

        


    	$workspace = new Workspace ;


        $workspace->title = $request->title ; 
    	$workspace->items = $items ;

        if($request->has('description')){

            $workspace->description = $request->description ; 
        }

    	$workspace->user_id = auth()->id(); 

    	$workspace->save(); 

    	Session::flash('flash','Workspace Created Succesfully!!'); 

    	return redirect()->route('workspace.show',['user' => auth()->user()->username, 'workspace' =>$workspace->id]) ; 


    }

    


    public function update(User $user,Workspace $workspace){

                //authorization 
                $this->authorize('update',$workspace);


                //validation
                 $this->validate(request(),[
                    'title' => 'required|max:100|spamfree',
                    'description' => 'spamfree'

                ]);
    		
				if(request()->wantsJson()){


					$items = request('items');



					$workspace->items =  $items ; 

                    $workspace->title = request('title');

                    $workspace->description = request('description');

					$workspace->save();

				

					return $workspace ; 
				}    		

    		 //$workspace->items =  request('codes');

    		



    		//$workspace->save();

    	

    		//return redirect()->back()->with('flash','Workspace Updated Successfully!');

    }

    public function destroy(User $user,Workspace $workspace){

        $this->authorize('delete',$workspace);

    	$workspace->delete(); 

        if(request()->WantsJson()){

            return response('Workspace Has Been Deleted',204);
        }


    	return redirect('/workspaces')
    		->with('flash','Workspace Deleted Successfully!!');
    }
}
