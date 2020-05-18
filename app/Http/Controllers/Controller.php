<?php

namespace App\Http\Controllers;

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

}
