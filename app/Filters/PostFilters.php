<?php 


namespace App\Filters ; 


use App\User ; 

class PostFilters extends Filters
{



	protected $filters = ['by','popular','order']; 



	public function by($username)
	{


		$user = User::where('username',$username)->firstOrFail();



		return $this->builder->where('user_id',$user->id);
	}

	public function popular()
	{

		$this->builder->getQuery()->orders = [] ; 

		return $this->builder->orderBy('views','desc');
	}

	public function order($value)
	{	

		if($value == 'oldest')
		{
			$this->builder->getQuery()->orders = [] ; 

			return $this->builder->oldest();

		}

		if($value == 'recent')
		{
			$this->builder->getQuery()->orders = [] ; 

			return $this->builder->latest();

		}

		if($value == 'alphabetic')

		{

			$this->builder->getQuery()->orders = [] ; 

			return $this->builder->orderBy('title','asc');
		}


		return $this->builder ; 
	}



}