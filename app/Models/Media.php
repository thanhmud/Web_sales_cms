<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

 	public function Post(){
		return $this->hasOne('App\Models\Post','media_id','id');
    }
     public function ProductMedia(){
    	return $this->hasOne('App\Models\ProductMedia','id','media_id');
    }
     public function Product(){
    	return $this->hasmany('App\Models\Product','product_media_id','id');
    }
    public function Slide()
    {
    	return $this->belongsTo('App\Models\Slide','media_id','id');
    }
    public function Company()
    {
        return $this->hasOne('App\Models\Company','favicon','id');
    }
     public function Profile()
    {
        return $this->belongsTo('App\Models\User','avatar','id');
    }
}
