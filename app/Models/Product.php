<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Product extends Model
{
	use HasApiTokens;

    protected $fillable = [
        'name'
    ];

    public function child_transactions(){
    	return $this->hasMany('App\Models\ChildTransaction');
    }
}
