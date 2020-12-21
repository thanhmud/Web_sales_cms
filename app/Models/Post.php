<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   	protected $table = 'post';

	public function Comment(){
    	return $this->hasMany('App\Models\Comment','post_id','id');
    }
    public function Media(){
		return $this->hasOne('App\Models\Media','id','media_id');
    }
     public function User(){
		return $this->hasOne('App\Models\User','id','user_id');
    }
}
