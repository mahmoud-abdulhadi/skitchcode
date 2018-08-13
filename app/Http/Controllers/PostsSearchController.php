<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post ; 

use App\Trends\TrendingPosts ; 

class PostsSearchController extends Controller
{
    

    public function show(TrendingPosts $trending)
    {


        $searchTerm = request('q');

        $posts = Post::search($searchTerm);

        if(request()->expectsJson()){

        	return $posts->get() ; 
        }


    	return view('admin.posts.index',[

            'posts' =>  $posts->paginate(3),
            'trends' => $trending->get()
        ]);

    }
}
