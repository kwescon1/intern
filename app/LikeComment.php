<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    //
    protected $fillable = ['user_id','comment_id','status'];

    public function commentlikes(){
    	return $this>belongsTo(Comment::class);
    }
}
