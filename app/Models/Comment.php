<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   	protected $table = 'comment';

   	public function Post(){
    	return $this->belongsTo('App\Models\Comment','id','post_id');
    }
    public function User(){
		return $this->hasOne('App\Models\User','id','user_id');
    }
    // đếm xem có bao nhiêu cái comment theo bài viết
	public static function commentCount($post_id){
		$commentCount = Comment::where(['post_id'=>$post_id])->where('status',2)->count();
		return $commentCount;
  }
  public static function rateCount($product_id){
    $rateCount = Comment::where(['product_id'=>$product_id])->where('status',2)->count();
    return $rateCount;
  }
}
