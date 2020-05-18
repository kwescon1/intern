<?php

// namespace App\Http\Livewire;

// use Livewire\Component;
// use Log;
// use Validator;
// use App\Advertisment;
// use App\Company;

class AddadvertForm extends Component
// {

// 	public $company_id;

// 	public $message;

// 	public $image;

//     public function render()
//     {
//     	$company = Company::all();

//         return view('livewire.addadvert-form')->with('company',$company);
//     }

//     public function submit(){

    
//     	$validator = $this->validate([
//     		'company_id' => 'required|integer',
//     		'image' => 'required|mimes:jpeg,png,jpg,bmp|max:2048',
//     		'message' => 'required|string'
//     	]);

//     	if ($validator->fails()){
             
// 	        Log::warning($validator->errors());
// 	        return $validator->errors();
// 		}

		

		// $image = $request->file('image');

  //       $name =time().'.'.rand().'.'.$image->getClientOriginalExten sion();
  //       $destinationPath = public_path('images/advert');
  //       $image->move($destinationPath, $name);

		// $advert = new Advertisment;

		// $advert->company_id = $request->company_id;
		// $advert->image = $name;
		// $advert->message = $request
		// ->message;

		// $advert->save();

  //       Log::info('Advert added. advert data here '. $request);

    	// Log::debug('Advert added. advert data here.', $validate);

  //       return back()->with('success', 'Advert added successfully');
//     }
// }
