<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use Log;
use App\Advertisment;
use App\Http\Controllers\Controller;

class ExclusiveController extends Controller
{
    //
    public function exclusive(){

	    $advertisment = Advertisment::latest()->where('status',1)->where('ad_type',2)->withCount(['comments','likeads'])->with(['comments' => function($query){
	    	$query->withCount('likecomments');
	    }])->get();


	    if(isset($advertisment) && $advertisment->toArray() != []){
	    	Log::info($advertisment);

	    	return $this->successResponse(["advertisment" => $advertisment,"message" => "successful"]);

	    }
	    return $this->errorResponse(404,"No advertisment found");
    }

    //write cron job to change the status of the advertisment when it expires
    
}
