<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});
// register through  social network
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

/****************************************
************* Post Routes *************
*******************************/ 

//show all categories 
Route::get('categories',[
	
	'uses' => 'CategoriesController@index',
	'as' => 'categories.index'
	]);

// create New Category 

Route::post('categories',[
	'uses' => 'CategoriesController@store',
	'as' => 'category.store'

]);

route::get('/post/delete/{id}',[
    'uses'=>'PostsController@destroy',
    'as'=>'post.delete'
  ]);



route::get('/posts/trashed',[
    'uses'=>'PostsController@trashed',
    'as'=>'posts.trashed'
  ]);
  route::get('/posts/kill/{id}',[
    'uses'=>'PostsController@kill',
    'as'=>'post.kill'
  ]);
  route::get('/posts/restore/{id}',[
    'uses'=>'PostsController@restore',
    'as'=>'post.restore'
  ]);



//Delete Category 

Route::delete('categories/{category}','CategoriesController@destroy');

//Update Category

Route::patch('categories/{category}','CategoriesController@update');


//Index Posts
Route::get('/posts',[
	'uses' => 'PostsController@index',
	'as' => 'posts.index'
]);


//endpint to search posts 

Route::get('/posts/search','PostsSearchController@show');

//endpoint to like a post 

Route::post('/posts/{post}/likes','PostsLikesController@store');
//endpoint to unlike a post 

Route::delete('/posts/{post}/likes','PostsLikesController@destroy');

//create post 
Route::get('posts/create','PostsController@create');

//edit post
route::get('/posts/edit/{id}',[
    'uses'=>'PostsController@edit',
    'as'=>'post.edit'
  ]);


//store post 
Route::post('/posts','PostsController@store')->name('post.store');;


//filter posts by tags

Route::get('/posts/tags/{tag}','PostsTagsController@show');

//filter posts by category
Route::get('posts/{category}','PostsController@index');

//fetch post tags
Route::get('/posts/{category}/{post}/tags','PostsTagsController@index');
//show post
Route::get('posts/{category}/{post}','PostsController@show');


//Delete A Post 

//Route::delete('/posts/{category}/{post}','PostsController@destroy');


//update post 

Route::patch('/posts/{category}/{post}','PostsController@update')->name('post.update');
//add a comment to a post 
Route::post('/posts/{category}/{post}/comments','CommentsPostController@store');

//Add A Reply to comment of a post 


Route::post('/posts/{category}/{post}/comments/{comment}/replies','CommentsPostController@reply');






/*******************************
/********* Thread Routes ********
***********************************/

Route::get('threads',[

	'uses' => 'ThreadsController@index',
	'as' => 'thread.index'
]);


Route::get('threads/create','ThreadsController@create');



Route::get('/threads/{channel}/{thread}/edit','ThreadsController@edit');



//Route to search for models 

Route::get('/threads/search','ThreadsSearchController@show');


//like a thread

Route::post('/threads/{thread}/likes','ThreadsLikesController@store');

//unlike a thread 
Route::delete('/threads/{thread}/likes','ThreadsLikesController@destroy');




//View Channels 

Route::get('channels','ChannelsController@index');

Route::post('channels',[
	'uses' => 'ChannelsController@store',
	'as' => 'channel.store'

]);


//Delete Channel

Route::delete('channels/{channel}','ChannelsController@destroy');

Route::patch('channels/{channel}','ChannelsController@update');

//create a thread
Route::post('threads','ThreadsController@store')->name('thread.store');

//fetch tags of a thread 

Route::get('/threads/{channel}/{thread}/tags','ThreadsTagsController@index');

//lock a thread 

Route::post('/locked-threads/{thread}','LockedThreadsController@store')
	->name('locked-threads.store')
	->middleware('admin');

//unlock a thread 
Route::delete('/locked-threads/{thread}','LockedThreadsController@destroy')
	->name('locked-threads.destroy')
	->middleware('admin');

//filter threads according to a tag 

Route::get('/threads/tags/{tag}','ThreadsTagsController@show');

//filter threads accoring to a channel 
Route::get('threads/{channel}','ThreadsController@index');



//Add A Comment to thread 

Route::post('/threads/{channel}/{thread}/comments','CommentsThreadController@store');

//Reply to comments of a thread

Route::post('/threads/{channel}/{thread}/comments/{comment}/replies','CommentsThreadController@reply');


//subscribe to a thread 
Route::post('threads/{channel}/{thread}/subscriptions','ThreadSubscriptionsController@store')->middleware('auth');

//unsubscribe from thread 
Route::delete('threads/{channel}/{thread}/subscriptions','ThreadSubscriptionsController@destroy');


//Delete A Thread 

Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy');

//update Thread 

Route::patch('/threads/{channel}/{thread}','ThreadsController@update')->name('thread.update');

//mark the best Reply 
Route::post('/comments/{comment}/best','BestRepliesController@store')
	->name('best-reply.store');



/******************************
/* Skitches Section
*******************************/ 

Route::get('/skitches',[
	'uses' => 'SkitchesController@index',
	'as' => 'skitch.index'

]);


//endpint to search skitches 

Route::get('/skitches/search','SkitchesSearchController@show');


//filter skitches by tags

Route::get('/skitches/tags/{tag}','SkitchesTagsController@show');




//filter sckitches according to user 

Route::get('/skitches/{user}','SkitchesController@index');

/* Create new Skitch View */
Route::get('/skitch',[
		'uses' => 'SkitchesController@create', 

		'as' => 'skitch.create'

]); 

/* Store Skitch to the Databse */ 

Route::post('/skitch',[
	'uses' => 'SkitchesController@store',
	'as' => 'code.store'
]);




/* Show Single Skitch */ 
Route::get('skitches/{user}/{skitch}',[
	'uses' => 'SkitchesController@show',
	'as' => 'skitch.show'

]);

//fetch the skitch tags

Route::get('/skitches/{user}/{skitch}/tags','SkitchesTagsController@index');


//endpoint to fork a skitch 

Route::post('/skitches/{user}/{skitch}/forks','ForksController@store');

//endpoint to getch forks of a skitch 

Route::get('/skitches/{user}/{skitch}/forks','ForksController@index');


//endpoint to fetch the forks of a user 
Route::get('users/{user}/forks','DashboardSkitchesController@index');



//endpoint to like a skitch 
Route::post('/skitches/{skitch}/likes','SkitchesLikesController@store');



//endpoint to dislike a skitch

Route::delete('/skitches/{skitch}/likes','SkitchesLikesController@destroy');

//show HTML View 
Route::get('/skitches/{user}/{skitch}/html',[

	'uses' => 'SkitchesViewsController@showHtml',
	'as' => 'skitch.html.show'

]);

//show CSS View 
Route::get('/skitches/{user}/{skitch}/css',[

	'uses' => 'SkitchesViewsController@showCss',
	'as' => 'skitch.css.show'

]);

//show JS View
Route::get('/skitches/{user}/{skitch}/js',[

	'uses' => 'SkitchesViewsController@showJs',
	'as' => 'skitch.js.show'

]);

//show full view 

Route::get('/skitches/{user}/{skitch}/full','SkitchesViewsController@showFull');

//Social View 
Route::get('/skitches/{user}/{skitch}/social','SkitchesViewsController@showSocial') ; 



//show social view

/* Update A Skitch */
Route::put('/skitches/{skitch}',[

	'uses' => 'SkitchesController@update',
	'as' => 'code.update'
]);



/* Delete A Skitch */
Route::delete('/skitches/{user}/{skitch}',[

	'uses' => 'SkitchesController@destroy',
	'as' => 'code.destroy'

]);
/** Add A Comment to a skitch */
Route::post('/skitches/{user}/{skitch}/comments','CommentsSkitchController@store');


/** Add to a reply  to a  comment of a skitch */
Route::post('/skitches/{user}/{skitch}/comments/{comment}/replies','CommentsSkitchController@reply');


/*****************
** Workspaces Routes Section 
*****************/

//show all workspaces recently 

Route::get('/workspaces',[
	'uses' => 'WorkspacesController@index',
	'as' => 'workspace.index'

]);


//endpint to search workspaces 

Route::get('/workspaces/search','WorkspacesSearchController@show');

//Create Workspace 
Route::get('/workspaces/create',[

	'uses' => 'WorkspacesController@create',
	'as' => 'workspace.create'


]);

//filter workspaces by tags 

Route::get('/workspaces/tags/{tag}','WorkspacesTagsController@show');


//filter workspaces by user  

Route::get('/workspaces/{user}','WorkspacesController@index');



Route::post('/workspaces/store',[


	'uses' => 'WorkspacesController@store',
	'as' => 'workspace.store'

]);

/*Show Workspace */ 
Route::get('workspaces/{user}/{workspace}',[

	'uses' => 'WorkspacesController@show',
	'as' => 'workspace.show']);


//Show change of workspace 
Route::get('/workspaces/{user}/{workspace}/changes','ChangesController@show');



/** fetch the workspace tags */ 
Route::get('workspaces/{user}/{workspace}/tags','WorkspacesTagsController@index');

/* Update Workspace */ 
Route::put('workspaces/{user}/{workspace}',[
	'uses' => 'WorkspacesController@update',
	'as' => 'workspace.update'

]);

/* Delete Workspace */ 

Route::delete('/workspaces/{user}/{workspace}',[

	'uses' => 'WorkspacesController@destroy',
	'as' => 'workspace.delete'
]);


/** Add Comment to Workspace */ 

Route::post('/workspaces/{user}/{workspace}/comments','CommentsWorkspaceController@store');



/** Add Reply to a comment of Workspace */ 

Route::post('/workspaces/{user}/{workspace}/comments/{comment}/replies','CommentsWorkspaceController@reply');


/** fetch participants of project */

Route::get('/workspaces/{user}/{workspace}/participants','ParticipantsController@index');

/** Add participants to Workspace */ 
Route::post('/workspaces/{workspace}/participants','ParticipantsController@store');

/** Remove Participants from workspace */ 
Route::delete('/workspaces/{workspace}/participants/{user}','ParticipantsController@destroy');

/*****************************
*******Comments Section **********
**************************************/



//endpoint to delete comment 

Route::delete('/comments/{comment}','CommentsController@destroy');

//endpoint to update a comment 
Route::patch('/comments/{comment}','CommentsController@update');

//endpoint to like comment 

Route::post('/comments/{comment}/likes','CommentsLikesController@store');

//endpoint to unlike a comment 

Route::delete('/comments/{comment}/likes','CommentsLikesController@destroy');



//******************************************************************
Auth::routes();

Route::get('/api/users','Api\UsersController@index');

Route::get('/profiles/{user}','ProfilesController@show')->name('profile');

Route::post('/api/users/{user}/avatar','Api\UserAvatarController@store')->middleware('auth')->name('avatar');

//get the notifications for user 

Route::get('/profiles/{user}/notifications','NotificationsController@index');

//mark notification as read
Route::delete('/profiles/{user}/notifications/{notification}','NotificationsController@destroy');	

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads/{channel}/{thread}','ThreadsController@show');

/********** Manage Tags Section */ 


//endpoint to fetch all tags
Route::get('/tags','TagsController@index')->middleware('admin');


//endpoint to store new 
Route::post('/tags','TagsController@store')->middleware('admin');

//endpoint to delete a tag 

Route::delete('/tags/{tag}','TagsController@destroy')->middleware('admin');


//admin manage users 

route::get('/users',[
    'uses'=>'AdminUsersController@index',
    'as' => 'users'
  ]);
 
  ////user_admin
  route::get('user/admin/{user}',[
    'uses'=>'AdminUsersController@admin',
    'as'=>'user.admin'
  ]);
  route::get('user/not-admin/{user}',[
    'uses'=>'AdminUsersController@not_admin',
    'as'=>'user.not.admin'
  ]);

  route::get('user/delete/{user}',[
    'uses'=> 'AdminUsersController@destroy',
    'as'=>'user.delete'
  ]);