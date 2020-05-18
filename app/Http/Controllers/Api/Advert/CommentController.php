<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Validator;
use App\Comment;

class CommentController extends Controller
{
    //
    public function comment(Request $request){
    	$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer', 
	        'user_id' => 'required|integer',
	        'comment' => 'required|text'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = new Comment;

		$data = [

				'advertisment_id' => $request->advertisment_id,
				'user_id' => $request->user_id,
				'comment' => $request->comment,
				'status' => 1
		];

		$comment->advertisment_id = $data['advertisment_id'];
		$comment->user_id = $data['user_id'];
		$comment->status = $data['status'];
		$comment->comment = $data['comment'];

		Log::info("comment is ".$data);

		$comment->save();

		return $this->successResponse(["comment" => $data,"message" => "comment saved successfully"]);
    }

    public function delComment(Request $request){
    	$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer', 
	        'user_id' => 'required|integer',
	        'comment' => 'required|text'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = Comment::where('advertisment_id', $request->advertisment_id)->where('user_id',$request->user_id)->where('comment',$request->comment)->first();
		$comment->status = 0;
		$comment->save();

		Log::warning("comment deleted successfully ".$comment); 

		return $this->successResponse(['comment' => $comment, 'message' => 'Comment deleted successfully']);
    }

    public function verifyComment(Request $request){
    	$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer', 
	        'user_id' => 'required|integer',
	        'comment' => 'required|text'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = Comment::where('advertisment_id',$request->advertisment_id)->where('user_id',$request->user_id)->where('comment', $request->comment)->first();

		if(isset($comment)){
			Log::info('comment verified '.$comment);

			return $this->successResponse(['comment' => $comment, 'message'=> 'Comment verified successfully']);	
		}

		return $this->errorResponse(401, "Comment retrieval failure");


	}

	public function editComment(Request $request){
		$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer', 
	        'user_id' => 'required|integer',
	        'old_comment' => 'required|text',
	        'new_comment' => 'required|text'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = Comment::where('advertisment_id',$request->advertisment_id)->where('user_id',$request->user_id)->where('comment',$request->old_comment)->first();

		if(isset($comment)){
			Log::info('comment verified '.$comment);

			$comment->comment = $request->new_comment;

			$comment->save();

			// $comment = Comment::where('advertisment_id',$request->advertisment_id)->where('user_id',$request->user_id)->where('comment',$request->old_comment)->first();

			Log::info('comment editted succesfully '.$comment);

			return $this->successResponse(['comment' => $comment, 'message'=> 'Comment updated successfully']);	
		}
		return $this->errorResponse(401,"comment update failure");
	}

	public function retrieveComment(Request $request){
		$validator = Validator::make($request->all(), [ 
	        'advertisment_id' => 'required|integer'
	    ]);

		if ($validator->fails()) { 

			Log::warning("comment essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$comment = Comment::latest()->where('advertisment_id',$request->advertisment_id)->get();

		if(isset($comment)){
			Log::info('comment retrieved '.$comment);

			$count = $comment->count();

			$data = [
				'comment' => $comment,
				'count' => $count
			];

			return $this->successResponse(['comment' => $data, 'message'=> 'Comment retrieved successfully']);
		}

		return $this->errorResponse(401,"comment retrieval failed");
	}
}