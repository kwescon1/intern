<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    //
    protected $fillable = ['email','student_ref','code'];
}
