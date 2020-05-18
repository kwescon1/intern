<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Advertisment extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['company_id','ad_type','image','message','total_slots','status'];

    protected $dates = ['deleted_at'];

    public function comments(){
    	return $this->hasMany(Comment::class)->where('status',1);
    }

    public function likeads(){
    	return $this->hasMany(LikeAd::class)->where('status',1);
    }

}


