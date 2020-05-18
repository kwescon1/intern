<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Advertisment;
use Log;


class AdvertismentController extends Controller
{
    //
    public function advert(){


	    $advertisment = Advertisment::latest()->where('status',1)->where('ad_type',1)->withCount(['comments','likeads'])->with(['comments' => function($query){
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
