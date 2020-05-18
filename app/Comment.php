<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['advertisment_id','comment','user_id','status'];// 0 for deleted 1 for active

    protected $dates = ['deleted_at'];

    public function likecomments(){
    	return $this->hasMany(LikeComment::class)->where('status',1);
    }

    public function ad(){
    	return $this->belongsTo(Advertisment::class);
    }

    public function exad(){
    	return $this->belongsTo(Exclusive::class);
    }

}
