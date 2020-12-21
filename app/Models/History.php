<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    public function Post(){
    	return $this->hasOne('App\Models\Post','id','link_id');
    }

    public function Product(){
    	return $this->hasOne('App\Models\Product','link_id','id');
    }
}
