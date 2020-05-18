<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Story extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['company_id','video','status']; //status is 0 for expired 1 for active

    protected $dates = ['deleted_at'];

}
