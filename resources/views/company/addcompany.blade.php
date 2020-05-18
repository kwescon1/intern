@extends('layouts.layout')

@section('title')
  Add company
 @endsection

@section('content')
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="{{url('addcompany')}}" enctype="multipart/form-data">

				@csrf

				@if(session()->has('success'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('success') }}
					</div>
				@endif
				
				<span class="contact100-form-title">
					Add Company
				</span>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Company Name</span>
					<input required class="input100" type="text" name="name" placeholder="Enter company name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">About</span>
				<textarea required class="input100" name="about" placeholder="About company"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Image Preview</span>
						<img id="preview" src="" width="200px" height="200px">
					<span class="focus-input100"></span>
				</div>

				<div>
					
					<input required name="image" type="file" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
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
@endsection