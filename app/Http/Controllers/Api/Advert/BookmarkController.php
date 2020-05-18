<?php

namespace App\Http\Controllers\Api\Advert;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bookmark;
use App\User;
use App\Advertisment;
use Log;
use Validator;

class BookmarkController extends Controller
{
    //
    public function bookmarkAd(Request $request){
    	$validator = Validator::make($request->all(), [ 
	        'user_id' => 'required|integer', 
	        'advertisment_id' => 'required|integer',
	    ]);

		if ($validator->fails()) { 

			Log::warning("bookmark essentials validation failed");
			return $this->errorResponse(401,$validator->errors());
		}

		$bookmark = Bookmark::where('user_id',$request->user_id)->where('advertisment_id',$request->advertisment_id)->first();

		if(isset($bookmark)){
			Log::info('bookmark already exist '.$bookmark);
			return $this->errorResponse(401, 'Bookmark already exist');
		}

		$data = array(
			'user_id' => $request->user_id,
			'advertisment_id' => $request->advertisment_id,
			'status' => 1 // 1 is for active 0 is for deleted
		);

		Log::warning("bookmark essentials validated successfully ". $data);


		$bookmark = new Bookmark;

		$bookmark->user_id = $data['user_id'];
		$bookmark->advertisment_id = $data['advertisment_id'];
		$bookmark->status = $data['status'];

		$bookmark->save();

		return $this->successResponse(["bookmark" => $data, "message" => "successful"]);
    }

    public function bookmark(Request $request){

    	$bookmark = User::where('id', $request->user_id)->with('bookmarks')->get();

    	if(isset($bookmark)){

    		Log::info('bookmark is '.$bookmark);

    		$temp = $bookmark[0]['bookmarks'];


	    	$advert = [];

	    	foreach ($temp as $val) {
	    		
	    		$advert[] = Advertisment::where('id',$val->advertisment_id)->get();
	    	}

	    	if(isset($advert)){

	    		return $this->successResponse(['advertisment' => $advert, 'message'=> 'bookmark retrieved successfully']);
	    	}
	    	return $this->errorResponse(404, 'Advert does not exist');
		}

		return $this->errorResponse(404, 'No bookmark made');
    }

    public function deleteBookmark(Request $request){
    	$validator = Validator::make($request->all(), [ 
	        'user_id' => 'required|integer', 
	        'advertisment_id' => 'required|integer',
	    ]);

			if ($validator->fails()) { 

				Log::warning("bookmark essentials validation failed");
				return $this->errorResponse(401,$validator->errors());
			}

			Log::warning("bookmark essentials validated successfully");

			if(isset($request->user_id) && isset($request->advertisment_id)){
				$bookmark = Bookmark::where('user_id',$request->user_id)->where('advertisment_id',$request->advertisment_id)->first();

				$bookmark->status = 0;
				$bookmark->save();

				return $this->successResponse(["bookmark" => $bookmark,"message" => "bookmark deleted"]);
			}	
		return $this->errorResponse(401,"No bookmark found");
    }
}
