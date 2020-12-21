<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $table = 'product_media';
    public function Product(){
    	return $this->hasMany('App\Models\Product','product_media_id','id');
    }
    public function Media(){
    	return $this->hasMany('App\Models\Media','media_id','id');
    }
}
