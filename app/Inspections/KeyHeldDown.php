<?php 


namespace App\Inspections ; 




class KeyHeldDown { 



	public function detect($body){


		if(preg_match('/(.)\\1{4,}/',$body,$matches)){

				throw new \Exception('Your Reply contains spam.');
			};	


	}
}


