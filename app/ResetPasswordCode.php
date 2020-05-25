<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPasswordCode extends Model
{
    //
    protected $fillable = ['email','student_ref','reset_code'];
}