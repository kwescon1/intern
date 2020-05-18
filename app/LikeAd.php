<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LikeAd extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['user_id','advertisment_id','status'];

    protected $dates = ['deleted_at'];

    public function adlike(){
    	return $this->belongsTo(Advertisment::class);
    }

}


