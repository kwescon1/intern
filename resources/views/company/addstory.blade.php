@extends('layouts.layout')

@section('title')
  Add story
 @endsection

@section('content')
	{{-- @livewire('addadvert-form') --}}

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="{{url('addstory')}}" enctype="multipart/form-data">

				@csrf

				@if(session()->has('success'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('success') }}
					</div>
				@endif

				@if(session()->has('failure'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('failure') }}
					</div>
				@endif

				<span class="contact100-form-title">
					Add Story
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
			
				{{-- <div class="wrap-input100 validate-input">
					<span class="label-input100">Video Preview</span>
						<video id="preview" src="" width="200px" height="200px"></video>
					<span class="focus-input100"></span>
				</div> --}}

				<div>
					
					<input required name="video" type="file" accept="video/*">
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