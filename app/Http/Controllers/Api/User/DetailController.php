<?php

namespace App\Http\Controllers\Api\User;

use Log;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    //
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['details' => $user], $this-> successStatus);     
    }

    public function updateDetails(Request $request){

    	$user = User::where('id',$request->id)->first();

        
        if(isset($user)){
            if($request->hasFile('file')){
                $validator = Validator::make($request->all(), [ 
                    'first_name' => 'required', 
                    'last_name' => 'required',
                    'middle_name' => 'nullable',
                    'file' => 'required|mimes:jpeg,png,jpg,bmp|max:2048'
                ]);

                if ($validator->fails()){
             
                    Log::warning("there's an error. Validator has failed");
                    return $this->errorResponse(422,$validator->errors());
                }


                    $image = $request->file('file');

                    $name =time().'.'.rand().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('file/images/user');
                    $image->move($destinationPath, $name);    
                    

                    // file_put_contents($name, base64_decode($request->file));



                    $user->first_name = $request->first_name;
                    $user->middle_name = $request->middle_name;
                    $user->last_name = $request->last_name;
                    $user->image = $name;

                    $user->save();

                
            }

            $validator = Validator::make($request->all(), [ 
                'first_name' => 'required', 
                'last_name' => 'required',
                'middle_name' => 'nullable'
            ]);

            if ($validator->fails()){

                Log::warning("there's an error. Validator has failed");
                return $this->errorResponse(422,$validator->errors());
            }

            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;

            $user->save();

            Log::warning($request ."user update successful");

            return $this->successResponse(['message'=> 'success','success'=>$user]);
        }  
        return $this->errorResponse(404,"Error updating"); 
    }
}
