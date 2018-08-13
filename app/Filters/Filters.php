<?php 

namespace App\Filters ; 


use Illuminate\Http\Request ; 

abstract class Filters {


	protected $filters = [] ; 



	protected $request ; 

	protected $builder ; 

	/**
	* Filters Constructor
	*/
	//Inject The Request to the constructor
	public function __construct(Request $request){

		$this->request = $request ; 

	}

	public function apply($builder){


		$this->builder = $builder ; 


		foreach ($this->getFilters() as $filter => $value) {
			
			if(method_exists($this, $filter))
			{

				$this->$filter($value);
			}
		}

		return $this->builder; 


	}


	public function getFilters(){

		//protect the app from crashing only filter by the parameters you want
		//handles when no parameter is passed 

		
		return $this->request->intersect($this->filters);
	}



}