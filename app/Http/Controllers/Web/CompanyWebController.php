<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Company;
use Log;
class CompanyWebController extends Controller
{
    //
    public function create(){
    	return view('company.addcompany');
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string',
    		'image' => 'required|mimes:jpeg,png,jpg,bmp|max:2048',
    		'about' => 'required|string'
    	]);

    	if ($validator->fails()){
             
	        Log::warning($validator->errors());
	        return $validator->errors();
		}

		$image = $request->file('image');

        $name =time().'.'.rand().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('images/company');
        $image->move($destinationPath, $name);

		$company = new Company;

		$company->name = $request->name;
		$company->image = $name;
		$company->about = $request
		->about;

		$company->save();

        Log::info('Company saved. Company data here '. $request);

        return back()->with('success', 'Company added successfully');

    }
}
