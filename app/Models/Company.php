<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public function Media(){
    	return $this->hasOne('App\Models\Media','id','favicon');
    }
}
