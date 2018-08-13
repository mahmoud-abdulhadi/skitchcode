<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Session ;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{

    //create consruction 
    public function __construct()
    {
        $this->middleware('admin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    public function destroy(User $user)
    {
        //
       // $user = User::find($id);

       // $user->profile->delete();

        $user->delete();

       Session::flash('flash','User deleted.');

        return redirect()->back();
    }

    public function admin(User $user)
    {
       // $user =User::find($id);

        $user->admin = 1;

        $user->save();

       Session::flash('flash','successfully changed user permissions.');

        return redirect()->back();
    }


    public function not_admin(User $user)
    {
       // $user =User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('flash','successfully changed user permissions.');

        return redirect()->route('home');
    }


}
