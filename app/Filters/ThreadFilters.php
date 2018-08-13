<?php 


namespace App\Filters ; 


use App\User ; 

class ThreadFilters extends Filters
{



	protected $filters = ['by','popular','unanswered']; 



	public function by($username)
	{


		$user = User::where('username',$username)->firstOrFail();



		return $this->builder->where('user_id',$user->id);
	}


	public function popular($value = 1){

		//remove existing order 

		

		$this->builder->getQuery()->orders = [];


		return $this->builder->orderBy('comments_count','desc');
	}


	 function unanswered()
	{

		
		return $this->builder->where('comments_count',0);

	}


}