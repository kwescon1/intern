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

class Registercontroller extends Controller
{
    //Always create a personal access client for the laravel passpot using php artisan passport:install
    
/**
    * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function register(Request $request){

		$validator = Validator::make($request->all(), [ 
		    'email' => 'required|email',
	        'student_ref' => 'required', 
	        'password' => 'required', 
	        'confirm_password' => 'required|same:password', 
	    ]);

	    if ($validator->fails()) { 

			Log::warning("user validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		Log::info("user validation successful");

		$email = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

		$ref = User::where('student_ref',$request->student_ref)->first();
	
		if(isset($email) || isset($ref)){
			Log::warning("user already exists");
			return $this->errorResponse(401,"User already exists");
		}

		Log::info('creating new user');
			
    	$data = $request->all(); 
        $data['password'] = bcrypt($data['password']);
        $data['status'] = 0; 
        $user = User::create($data); 
        $success['token'] =  $user->createToken('Internship')-> accessToken; 
        // $success['first_name'] =  $user->first_name;
        // $success['last_name'] =  $user->last_name;
        // $success['first_name'] =  $user->first_name;
        $success['email'] =  $user->email;
        $success['student_ref'] =  $user->student_ref;
        $success['password'] =  $user->password;
        $success['status'] = $user->status;

        Log::info("user created successfully");

        $code = strtoupper(Str::random(7));

        $savecode = new VerifyCode;

   			$savecode->create([
   				'email' => $user->email,
   				'student_ref' => $user->student_ref,
   				'code' => $code
   			]);

        $this->registermail($user->student_ref,$user->email,$code);

        return $this->successResponse(['message'=> 'success','user'=> [
        	'data' => $success,
        	'message' => 'check email for code to activate account'
        	]
        ]);	
	}

	public function activatAccount(Request $request){

		$validator = Validator::make($request->all(), [
    		'code' =>'required',
    		'email' => 'required|email',
    		'student_ref' => 'required'
    	]);

    	if ($validator->fails()){
    		Log::warning("there's an error. Validator has failed.");
            return $this->errorResponse(422,$validator->errors());
	    }

    	$verify = VerifyCode::where('code',$request->code)->first();

    	if(isset($verify)){
    		$diff_in_minutes = Carbon::now()->diffInMinutes($verify->created_at);

    		if($diff_in_minutes <= 30){

    			$user = User::where('email',$request->email)->where('student_ref',$request->student_ref)->first();

    			$user->status = 1;
    			$user->save();

    			return $this->successResponse(['message'=> 'success',
    				'user'=> [
    					'data' => $user,
    					'message' => "User activated successfully"
    				]
    			]);
    		}
    		return $this->errorResponse(404,"Code has expired. Try again");
    	}

    	return $this->errorResponse(404,"Invalid code. Thank you");
	}
}
