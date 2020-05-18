<?php

namespace App\Http\Controllers\Api\User;

use Log;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            
            $user = Auth::user(); 
            
            $token =  $user->createToken('Internship')-> accessToken;
             
            Log::warning("Log in successful");
            return $this->successResponse(['message'=> 'success','token'=>$token]);
        }else{ 

            Log::warning('user login failure');
            return $this->errorResponse(404,"Unauthorised. Invalid Login Attempt");
        } 
    }
}
