<?php 


namespace App\Trends ; 

use Illuminate\Support\Facades\Redis ; 

use App\Thread ; 


class TrendingThreads extends Trending{
	
	



	public function cacheKey()
	{

			return app()->environment('testing') ? 'testing_trending_discussions' : 'trending_discussions'; 
	}

}