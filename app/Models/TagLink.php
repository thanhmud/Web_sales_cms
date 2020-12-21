<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagLink extends Model
{
    protected $table = 'tag_link';
    public function ProductMedia(){
    	// return $this->hasMany('App\Models\ProductMedia','product_media_id','id');
    }
    public function Media(){
    	// return $this->hasMany('App\Models\Media','product_media_id','id');
    }
    public function Tag(){
    	return $this->hasOne('App\Models\Tag','id','link_id');
    }
}
