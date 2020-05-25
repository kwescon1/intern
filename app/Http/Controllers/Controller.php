<?php

namespace App\Http\Controllers;

use Mail;
use Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $successStatus = 200;


    public function successResponse($data) {

    	$data["message"] = "success";

    	return response()->json($data, $this->successStatus);
    }

    public function errorResponse($errorCode,$error) {
    	return response()->json(["error" => $error],$errorCode);
    }


    public function resetmail($name,$email,$student_ref,$code){

    	$data = [
    		'name'=> $name,
    		'code'=> $code,
    		'ref'=> $student_ref,
    		'email'=> $email
    	];

    	Log::info($data);

    	Mail::send('mail.reset', $data, function($message) use ($data){
    		$message->to($data['email'], $data['name'])->subject('Password Reset');
    	});

    	return;
    }

    public function registermail($student_ref,$email,$code){

    	$data = [
    		'ref'=> $student_ref,
    		'email'=> $email,
    		'code' => $code
    	];

    	Log::info($data);

    	Mail::send('mail.register', $data, function($message) use ($data){
    		$message->to($data['email'], "")->subject('Account activation');
    	});

    	return;
    }
}
