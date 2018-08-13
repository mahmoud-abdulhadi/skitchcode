<?php 


namespace App\Trends ; 

use Illuminate\Support\Facades\Redis ; 

use App\Post ; 


class TrendingPosts extends Trending{
	
	



	public function cacheKey()
	{

			return app()->environment('testing') ? 'testing_trending_posts' : 'trending_posts'; 
	}

}