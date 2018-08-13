<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage  ; 

use App\Skitch ; 
use App\User; 

use Auth ; 
use Session ; 

use App\Filters\SkitchFilters;

/**
*This controller will controle The CRUD of Codes 
*/
class SkitchesController extends Controller
{
   

 public function __construct(){

    $this->middleware('auth')->except(['index','show']);
 }


 
    public function getSkitches(User $user,SkitchFilters $filters){

        $skitches = Skitch::latest()->filter($filters) ; 


        if($user->exists){

            $skitches = $skitches->where('user_id',$user->id); 
        }


        return $skitches->get();

    }



   public function index(User $user,SkitchFilters $filters){

    $skitches = $this->getSkitches($user,$filters);


    return view('skitches.index',compact('skitches'));

   } 

    public function create(){

        //clear the content of sandbox 
        //$file_name = '/public/sandbox.html' ; 

        //Storage::put($file_name,'');

    	return view('skitches.create') ; 
    }



    public function store(Request $request){

        $this->validate($request,[

            'title' => 'required|max:100|spamfree',
            'code' => 'required',
            'description' => 'spamfree'

        ]);

            //Create A New Skitch 

            $skitch = new Skitch;

            $skitch->title = $request->title;

            if($request->has('description')){

                $skitch->description = $request->description ; 
            }
            //set the code
            $skitch->code = $request->code;

            //dd skitch code 

            //dd($skitch->code);

            $skitch->user_id = auth()->id() ; 
            //save it 
            $skitch->save(); 

            //return with Success message 

            //reditect back 

              Session::flash('flash','Skitch Created Successfully!');

            return redirect()->route('skitch.show',['user' => Auth::user()->username,'skitch' => $skitch->id ]);
            
    }


    public function show(User $user,Skitch $skitch){

       // dd($skitch->code);

        //update the skitch views 

       $skitch->increment('views');

        return view('skitches.show',compact('skitch'));

    }
   

    public function update(Request $request,Skitch $skitch){
        //authorization 
        $this->authorize('update',$skitch);

        //validation 
        $this->validate(request(),[

            'title' => 'required|max:100|spamfree',
            'code' => 'required',
            'description' => 'spamfree'

        ]);

        if(request()->wantsJson()){

            $skitch->code = request('code');

            $skitch->title = request('title');
            $skitch->description = request('description');

            $skitch->save();


            

            return $skitch ;  

        }

        $skitch->code = $request->code ; 


        $skitch->save(); 

        Session::flash('flash','Skitch Updated Successfully!');

      


        return redirect()->back(); 

    }


    public function destroy(User $user , Skitch $skitch){

        $this->authorize('delete',$skitch);

        $skitch->delete(); 

        if(request()->wantsJson()){

            return response([],204);
        }
        return redirect()->route('skitch.index')
            ->with('flash','Skitch Deleted Successfully!!');
    }
}
