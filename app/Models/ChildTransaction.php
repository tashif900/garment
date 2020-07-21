<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class ChildTransaction extends Model
{
	use HasApiTokens;

    protected $fillable = [
        'product_id', 'quantity', 'color', 'price','discount','master_transaciton_id'
    ];

    public function product(){
    	return $this->belongsTo('App\Models\Product');
    }

    public function master_transaction(){
    	return $this->belongsTo('App\Models\MasterTransaction');
    }
}
