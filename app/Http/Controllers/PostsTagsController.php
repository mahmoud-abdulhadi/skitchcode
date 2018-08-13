<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trends\TrendingPosts;

use App\Tag ; 
use App\Post ; 

use App\Category ; 
class PostsTagsController extends Controller
{
    

      public function show(Tag $tag,TrendingPosts $trending){


    	$posts = $tag->posts()->paginate(4) ; 

    	if(request()->expectsJson()){

    		return $posts ; 

    	}

    	return view('admin.posts.index',[

            'posts' =>  $posts,
            'trends' => $trending->get()
        ]);


    }

    public function index(Category $category , Post $post){

        if(request()->wantsJson()){

            return $post->tags ; 
        }
    }
}
