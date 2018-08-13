<?php 


namespace App\Filters ; 


use App\User ; 

class WorkspaceFilters extends Filters
{



	protected $filters = ['user','popular','order']; 



	public function user($username)
	{


		$user = User::where('username',$username)->firstOrFail();



		return $this->builder->where('user_id',$user->id);
	}


	public function popular()
	{

		$this->builder->getQuery()->orders = [] ; 

		return $this->builder->orderBy('views','desc');
	}


}