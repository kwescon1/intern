<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Validator;
use App\LikeComment;

class LikeCommentController extends Controller
{
    //
    public function like(Request $request){
    	$validator = Validator::make($request->all(), [ 
	       'user_id' => 'required|integer',
	       'comment_id' => 'required|integer'
	    ]);

	    if ($validator->fails()) { 

			Log::warning("like comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$likecomment = LikeComment::where('user_id',$request->user_id)->where('comment_id',$request->comment_id)->where('status', 1)->first();

		if(isset($like)){
			return $this->errorResponse(401, 'comment already liked');
		}

		$likecomment->user_id = $request->user_id;
		$likecomment->comment_id = $request->comment_id;
		$likecomment->status = 1;

		$likecomment->save();

		Log::info('comment liked '.$likecomment);

		$count = LikeComment::where('comment_id',$request->comment_id)->where('status',1)->count();

		$data = [
			'comment' => $likecomment,
			'commentcount' => $count
		];


	    return $this->successResponse(["like" => $data,"message" => "comment liked successfully. Total count returned"]);
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

		$dislikecomment = LikeComment::where('user_id',$request->user_id)->where('comment_id',$request->comment_id)->where('status', 1)->first();

		if(isset($dislikecomment)){

			$dislikecomment->status = 0;
			$dislikecomment->save();

			$count = LikeComment::where('comment_id',$request->commment_id)->where('status',1)->count();

			$data = [
				'comment' => $dislikecomment,
				'commentcount' => $count
			];

	    	return $this->successResponse(["like" => $data,"message" => "advertisment disliked successfully. Total count returned"]);	
		}

		Log::info('comment to dislike dont exist');
		return $this->errorResponse(401, 'comment doesnt exist');
    }

    public function commentLike(Request $request){
		$validator = Validator::make($request->all(), [ 
	        'comment_id' => 'required|integer'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment like essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = LikeComment::where('comment_id',$request->comment_id)->get();

		if(isset($comment)){
			Log::info('comment like retrieved '.$comment);

			$count = $comment->count();

			$data = [
				'comment' => $comment,
				'count' => $count
			];

			return $this->successResponse(['data' => $data, 'message'=> 'data retrieved successfully. Total count returned']);
		}

		return $this->errorResponse(401,"like retrieval failed");
	}

}
