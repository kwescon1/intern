@extends('layouts.layout')

@section('title')
  Add advert
 @endsection

@section('content')
	{{-- @livewire('addadvert-form') --}}

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="{{url('addadvert')}}" enctype="multipart/form-data">

				@csrf

				@if(session()->has('success'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('success') }}
					</div>
				@endif

				@if(session()->has('total'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('total') }}
					</div>
				@endif

				@if(session()->has('company'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('company') }}
					</div>
				@endif

				@if(session()->has('failure'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('failure') }}
					</div>
				@endif

				<span class="contact100-form-title">
					Add Advert
				</span>

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Company Name</span>

					
					<div>
						@if($company->count() > 0)
							
								<select class="selection-2" name="company_id">
			
									<option value="0">Choose company</option>
									@foreach($company as $name)
									<option value="{{$name->id}}">{{$name->name}}</option>
									@endforeach

								</select>		
						@else
						<p>No Company available</p>
						@endif
					</div>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Advert Type</span>	
					<div>		
						<select id="ad_type" class="selection-2" name="ad_type">

							<option value="0">Choose Ad Type</option>
							<option value="1">Normal</option>
							<option value="2">Exclusive</option>

						</select>		
					</div>
					<span class="focus-input100"></span>
				</div>

				
				<div id="slots" class="wrap-input100 validate-input">
					<span class="label-input100">Total slots</span>
				<input class="input100" name="total_slots" type="number" placeholder="Number of slots" min="1" />
					<span class="focus-input100"></span>
				</div>
				

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Message</span>
				<textarea required class="input100" name="message" placeholder="Advertisment specifications"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Image Preview</span>
						<img id="preview" src="" width="200px" height="200px">
					<span class="focus-input100"></span>
				</div>

				<div>
					
					<input required name="image" type="file" accept="image/*" multiple onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
				</div>

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
@endsection