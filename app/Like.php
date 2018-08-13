<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model implements Recordable
{
	use RecordsActivityTrait ; 
	
    protected $guarded = [];


    public function likeable(){

    	$this->morphTo();
    }
}
