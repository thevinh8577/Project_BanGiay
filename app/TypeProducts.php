<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProducts extends Model
{
    protected $table="type_products";
    public function product(){
    	return $this->hasMany('App\Products','id_type','id');
    }
}
