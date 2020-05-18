<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Story;
use App\Company;
use Log;

class AddStoryController extends Controller
{
    //

    public function create(){
        $company = Company::all();

        return view('company.addstory')->with('company',$company);
    }

    public function store(Request $request){
        if($request->company_id == 0 || $request->company_id == null){
            return back()->with('company', 'Please choose company ');
        }

        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'video' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ]);

        if ($validator->fails()){
             
            Log::warning($validator->errors());
            return $validator->errors();
        }


        $video = $request->file('video');

        $name =time().'.'.rand().'.'.$video->getClientOriginalExtension();
        $destinationPath = public_path('file/video');
        $video->move($destinationPath, $name);

        $vid = new Story;

        $vid->company_id = $request->company_id;
        $vid->video = $name;
        $vid->status = 1; //0 for expired 1 for active

        $vid->save();

        Log::info('Story added successfully. company ID is '. $request->company_id . ", video name is ".$name);

        return back()->with('success', 'Story added successfully');
    }   
}