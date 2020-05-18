<?php

namespace App\Http\Controllers\Api\Story;

use Illuminate\Http\Request;
use Log;
use Validator;
use App\Story;

class StoryController extends Controller
{
    //

    public function story(){
    	$story = Story::latest()->where('status', 1)->get();

	    if(isset($story) && $story->toArray() != []){
	    	Log::info($story);

	    	return $this->successResponse(["story" => $story,"message" => "story retrieved successfully"]);

	    }
	    
	    return $this->errorResponse(404,"No advertisment found");

    //write cron job to change the status of the story when it expires

    }
}
