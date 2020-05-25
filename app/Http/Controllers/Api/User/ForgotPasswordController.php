<?php

namespace App\Http\Controllers\Api\User;

use Log;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\VerifyCode;
use Carbon\Carbon;


class ForgotPasswordController extends Controller
{
    //
    public function forgotPassword(Request $request){

    	$validator = Validator::make($request->all(), [
    		'email' =>'required|email',
    		'student_ref' => 'required',
    	]);

    	if ($validator->fails()){
    		Log::warning("there's an error. Validator has failed.");
            return $this->errorResponse(422,$validator->errors());
	    }

    	$user = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

    	if(isset($user)){
    		Log::warning("Sending approval code");

   			$name = $user->last_name." ".$user->first_name." ".$user->middle_name;
   			$student_ref = $user->student_ref;
   			$email = $user->email;
   			$code = strtoupper(Str::random(7));

   			$savecode = new VerifyCode;

   			$savecode->create([
   				'email' => $email,
   				'student_ref' => $student_ref,
   				'code' => $code
   			]);

    		$this->sendmail($name,$email,$student_ref,$code);


            return $this->successResponse(['message'=> 'success','success'=> "Password reset code generated. Please check your mail"]);
    	}

    	return $this->errorResponse(404,"Wrong email or student reference");
    }

    public function verifyCode(Request $request){

    	$validator = Validator::make($request->all(), [
    		'code' =>'required',
    	]);

    	if ($validator->fails()){
    		Log::warning("there's an error. Validator has failed.");
            return $this->errorResponse(422,$validator->errors());
	    }

    	$verify = VerifyCode::where('code',$request->code)->first();

    	if(isset($verify)){
    		$diff_in_minutes = Carbon::now()->diffInMinutes($verify->created_at);

    		if($diff_in_minutes <= 30){

    			return $this->successResponse(['message'=> 'success','user'=> $verify]);
    		}
    		return $this->errorResponse(404,"Code has expired. Try again");
    	}

    	return $this->errorResponse(404,"Invalid code. Thank you");
    }

        
    
    public function setPassword(Request $request){

    	$validator = Validator::make($request->all(), [  
    		'email' => 'required|email',
    		'student_ref' => 'required',
	        'password' => 'required', 
	        'confirm_password' => 'required|same:password' 
	    ]);

		if ($validator->fails()) { 

			Log::warning($validator->errors());
			return $this->errorResponse(401,$validator->errors());
		}

		Log::warning("Validation successfyl");

		$user = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

    	$user->password = bcrypt($request->password);
    	$user->save(); 
    
        
        Log::warning("password changed successfully");
        
        return $this->successResponse(['message'=> 'success','password'=>"Password changed successfully "]);
	
	}
}
