<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skitch ; 

use App\User ; 

class SkitchesViewsController extends Controller
{
    



    public function showHtml(User $user ,Skitch $skitch){


    	return view('skitches.html',['skitch' => $skitch]);

    }


     public function showCss(User $user ,Skitch $skitch){


    	return view('skitches.css',['skitch' => $skitch]);

    }

     public function showJs(User $user ,Skitch $skitch){


    	return view('skitches.Js',['skitch' => $skitch]);

    }

    public function showFull(User $user , Skitch $skitch){


    	return view('skitches.full', ['skitch' => $skitch]);
    }

    public function showSocial(User $user , Skitch $skitch)
    {


        return view('skitches.social', ['skitch' => $skitch]);

    }
}

