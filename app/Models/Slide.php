<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slide';

    public function MediaSlide()
    {
    	return $this->belongsTo('App\Models\Media','media_id','id');
    }
}
