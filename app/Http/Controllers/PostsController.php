<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post ; 
use App\Category ; 

use App\Trends\TrendingPosts ; 

use App\Filters\PostFilters ; 

use App\Tag ; 

class PostsController extends Controller
{
    public function __construct(){

        $this->middleware('auth')->except(['index','show']);
    }


    public function getPosts(Category $category,PostFilters $filters){

        $posts = Post::latest()->filter($filters) ; 


        if($category->exists){

            $posts = $posts->where('category_id',$category->id); 
        }


        return $posts->paginate(3);

    }
    

    public function index(Category $category,PostFilters $filters , TrendingPosts $trending){

    	




    	
        $posts = $this->getPosts($category,$filters) ; 


    	return view('admin.posts.index',[

            'posts' =>  $posts,
            'trends' => $trending->get()
        ]);
    }


    public function show(Category $category,Post $post,TrendingPosts $trending)
    {


        $trending->push($post);

        $post->increment('views');

        
    	return view('posts.show',compact('category','post')); 

    }

    public function create()
    {
        $categories =Category::all();

        $tags =Tag::all();
            
        return view ('Posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required|spamfree',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);


       $post =  Post::create([
            'title' => request('title'),
            'content' => request('content'),
            'category_id' => request('category_id'),
            'user_id' =>auth()->id()

        ]);


        if(request()->hasFile('cover')){

            $cover = $request->cover ; 

            $coverNewName = time() . $cover->getClientOriginalName();

            $cover->move('uploads/posts',$coverNewName) ; 

            $post->cover = 'uploads/posts/' . $coverNewName ;  
            
        }else {

            $post->cover = asset('imgs/posts/default.png');
        }

        $post->save();

        return redirect($post->path());
    }

     public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();

        $categories = Category::all();
        
        return view('posts.edit' , compact(['post','tags','categories']));
    }

   /* public function destroy(Category $category,Post $post){

        $this->authorize('delete',$post);

        $post->forceDelete();
        if(request()->wantsJson()){


            return response([],204);
        }

        return redirect('/posts')
                ->with('flash','Post Deleted Successfully!');

    }*/


     public function destroy($postId)
    {

        $post = Post::find($postId);

        
        $this->authorize('delete',$post);

        $post->delete();
        if(request()->wantsJson()){


            return response([],204);
        }

        Session::flash('flash','The Post was just trashed.');
        
        return redirect('/posts');
    }

    public function trashed()
    {
        $posts =Post::onlyTrashed()->get();

        return view('posts.trashed')->with('posts', $posts);
    }

    public function kill ($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();

        $post->forceDelete();

        Session::flash('flash','Post deleted permanently.');

        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();

        $post->restore();

        Session::flash('flash','Post restored successfully.');

        return redirect()->route('posts.index');
    }

    public function update(Category $category , Post $post)
    {
        //authorization 
        $this->authorize('update',$post);

        //validation 
        $this->validate(request(),[

            'title' => 'required',
            'content' => 'required',
            'cover' => 'image',
            'category_id' => 'exists:categories,id'

        ]);

        //update
        $post->update([

            'title' => request('title'),
            'content' => request('content'),
           
        ]);

        if(request()->hasFile('cover')){

             $cover = request()->cover ; 

             $coverNewName = time() . $cover->getClientOriginalName();

            $cover->move('uploads/posts',$coverNewName) ; 

            $post->cover = 'uploads/posts/' . $coverNewName ;  
        }

       
        if(request('category_id')){

            $post->category_id = request('category_id');

            $post->save();
        }

        return redirect($post->path()) ;

    }
}
