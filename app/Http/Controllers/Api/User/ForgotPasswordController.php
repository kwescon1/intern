<?php

namespace App\Http\Controllers\Api\User;

use Log;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;


class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword(Request $request){

    	$user = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

        
        if(isset($user)){

            $validator = Validator::make($request->all(), [ 
                'email' => 'required|email',
	        	'student_ref' => 'required',
            ]);

            if ($validator->fails()){
             
	            Log::warning("there's an error. Validator has failed.");
	            return $this->errorResponse(422,$validator->errors());

            }else{

                Log::warning("About to set new password");

                return $this->successResponse(['message'=> 'success','success'=> "Allowed to set password"]);
            }
        }

        return $this->errorResponse(404,"Wrong email or student reference");
    }

    public function setPassword(Request $request){

    	$user = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

    	$validator = Validator::make($request->all(), [  
	        'password' => 'required', 
	        'confirm_password' => 'required|same:password', 
	    ]);

		if ($validator->fails()) { 

			Log::warning("password validation failed");
			return $this->errorResponse(401,$validator->errors());
		        
		}else{
			Log::warning("password validated successfully");
	    	$user->password = bcrypt($request->password);
	    	$user->save(); 
	    
	        
	        Log::warning("password changed successfully");
	        
	        return $this->successResponse(['message'=> 'success','success'=>"Password changed successfully ".bcrypt($request->password)]);
    	}
	}
}
