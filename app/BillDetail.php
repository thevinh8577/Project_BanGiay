<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table="bill_detail";

    public function products(){
    	return $this->belongTo('App\Products',
    		'id_product','id');
    }
    public function bill(){
    	return $this->belongTo('App\Bill',
    		'id_bill','id');
    }
    
}
