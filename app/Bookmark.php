<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['user_id','advertisment_id','status'];

    protected $dates = ['deleted_at'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

}
