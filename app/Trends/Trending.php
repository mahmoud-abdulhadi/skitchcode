<?php 


namespace App\Trends ; 

use Illuminate\Support\Facades\Redis ; 

abstract class Trending {


	protected $model  ; 
	public function get(){


		 return array_map('json_decode',Redis::zrevrange($this->cacheKey(),0,4));
	}

	
	public function push($model){


		Redis::zincrby($this->cacheKey(),1,json_encode([
               'title' => $model->title, 
               'path' => $model->path() 
            ]));
	}



	

	public function reset(){

		Redis::del($this->cacheKey());
	}


	protected abstract function cacheKey();

}