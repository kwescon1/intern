<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Advertisment;
use App\Exclusive;
use App\Company;
use Log;

class AddAdvertController extends Controller
{
    //

    public function create(){
    	$company = Company::all();

    	return view('company.addadvert')->with('company',$company);
    }

    public function store(Request $request){


        if($request->company_id == 0 || $request->company_id == null){
            return back()->with('company', 'Please choose company ');
        }

    	$validator = Validator::make($request->all(), [
    		'company_id' => 'required|integer',
    		'image' => 'required|mimes:jpeg,png,jpg,bmp',
    		'message' => 'required|string',
            'total_slots' => 'nullable|integer',
            'ad_type' => 'required|integer'
    	]);

    	if ($validator->fails()){
             
	        Log::warning($validator->errors());
	        return $validator->errors();
		}


		$image = $request->file('image');

        $name =time().'.'.rand().'.'.$image->getClientOriginalExtension();


        if($request->ad_type == 2){
             if($request->total_slots == null){
                return back()->with('total', 'Please state number of slots ');
             }    

            $destinationPath = public_path('file/images/advert/exclusive');
            $image->move($destinationPath, $name);

        }else if($request->ad_type == 1){

            $destinationPath = public_path('file/images/advert/normal');
            $image->move($destinationPath, $name);
        }
        


        if($request->ad_type == 0){

            return back()->with('failure', 'Please choose advert type ');
        }
        
        $advert = new Advertisment;

        $advert->company_id = $request->company_id;
        $advert->image = $name;
        $advert->message = $request->message;
        $advert->ad_type = $request->ad_type;
        $advert->total_slots = $request->total_slots;
        $advert->status = 1 ;

        $advert->save();


        Log::info('Advert added. advert data here. company_id is '. $request->company_id . ", image name is ".$name. ", message is ". $request->message. "total slots are ".$request->total_slots." advertisment type is ".$request->ad_type. " total slots are ". $request->total_slots);

        return back()->with('success', 'Advert added successfully');
    }   
}