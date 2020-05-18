<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Validator;
use App\LikeAd;

class LikeAdController extends Controller
{
    //

    public function like(Request $request){
    	$validator = Validator::make($request->all(), [ 
	       'user_id' => 'required|integer',
	       'advertisment_id' => 'required|integer'
	    ]);

	    if ($validator->fails()) { 

			Log::warning("like essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$like = LikeAd::where('user_id',$request->user_id)->where('advertisment_id',$request->advertisment_id)->where('status', 1)->first();

		if(isset($like)){
			return $this->errorResponse(401, 'item already liked');
		}

		$like->user_id = $request->user_id;
		$like->advertisment_id = $request->advertisment_id;
		$like->status = 1;

		$like->save();

		Log::info('item liked '.$like);

		$count = LikeAd::where('advertisment_id',$request->advertisment_id)->where('status',1)->count();

		$data = [
			'user' => $like,
			'adcount' => $count
		];


	    return $this->successResponse(["like" => $data,"message" => "advertisment liked successfully. Total count returned"]);
    }

    public function unlike(Request $request){
    	$validator = Validator::make($request->all(), [ 
	       'user_id' => 'required|integer',
	       'advertisment_id' => 'required|integer'
	    ]);

	    if ($validator->fails()) { 

			Log::warning("like essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$dislike = LikeAd::where('user_id',$request->user_id)->where('advertisment_id',$request->advertisment_id)->where('status', 1)->first();

		if(isset($dislike)){

			$dislike->status = 0;
			$dislike->save();

			$count = LikeAd::where('advertisment_id',$request->advertisment)->where('status',1)->count();

			$data = [
				'user' => $dislike,
				'adcount' => $count
			];

	    	return $this->successResponse(["like" => $data,"message" => "advertisment disliked successfully. Total count returned"]);	
		}

		Log::info('item to dislike dont exist');
		return $this->errorResponse(401, 'Item doesnt exist');
    }

    public function retrieveLike(Request $request){
		$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer'
	    ]);

		if ($validator->fails()) { 

			Log::warning("like essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$like = LikeAd::where('advertisment_id',$request->advertisment_id)->get();

		if(isset($like)){
			Log::info('like retrieved '.$like);

			$count = $like->count();

			$data = [
				'like' => $like,
				'count' => $count
			];

			return $this->successResponse(['data' => $data, 'message'=> 'data retrieved successfully. Total count returned']);
		}

		return $this->errorResponse(401,"like retrieval failed");
	}

}
