<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class MasterTransaction extends Model
{
	use HasApiTokens;

    protected $fillable = [
        'client_name', 'price', 'discount'
    ];

    public function child_transactions(){
    	return $this->hasMany('App\Models\ChildTransaction');
    }
}
