<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table="products";
    public function product_type(){
    	return $this->belongTo('App\TypeProducts','id_type','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail',
    		'id_product','id');
    }
}
