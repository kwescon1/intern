<?php

namespace App\Http\Controllers\Api\User;

use Log;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller; 

class Registercontroller extends Controller
{
    //Always create a personal access client for the laravel passpot using php artisan passport:install
    
/**
    * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function register(Request $request) 
	{ 
		$user = User::where('email',$request->email)->first();
		$ref = User::where('student_ref',$request->student_ref)->first();
		if(isset($user) || isset($ref)){
			Log::warning("cant duplicate user");
			return $this->errorResponse(401,"Email or student_ref already exist");
		}else{
			$validator = Validator::make($request->all(), [ 
	        'first_name' => 'required', 
	        'last_name' => 'required',
	        'email' => 'required|email',
	        'student_ref' => 'required', 
	        'password' => 'required', 
	        'confirm_password' => 'required|same:password', 
	    ]);
			Log::warning("user validation successful");

			if ($validator->fails()) { 

				Log::warning("user validation failed");
				return $this->errorResponse(401,$validator->errors());
		        
		    }else{
		    	$input = $request->all(); 
		        $input['password'] = bcrypt($input['password']);
		        $input['status'] = "1"; 
		        $user = User::create($input); 
		        $success['token'] =  $user->createToken('Internship')-> accessToken; 
		        $success['first_name'] =  $user->first_name;
		        $success['last_name'] =  $user->last_name;
		        $success['email'] =  $user->email;
		        $success['student_ref'] =  $user->student_ref;
		        $success['first_name'] =  $user->first_name;
		        $success['password'] =  $user->password;
		        $success['status'] = $user->status;

		        Log::warning("user created successfully");
		        return $this->successResponse(['message'=> 'success','success'=>$success]);

		    }
		}
	}
}
