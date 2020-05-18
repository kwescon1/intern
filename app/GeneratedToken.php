<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneratedToken extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable = ['generated_token'];

    protected $dates = ['deleted_at'];
}
