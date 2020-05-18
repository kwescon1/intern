{{-- <div class="container-contact100">
		<div class="wrap-contact100">
			<form wire:submit.prevent="submit" class="contact100-form validate-form" enctype="multipart/form-data">

				@if(session()->has('success'))
					<div style="text-align: center; color: green" class="wrap-input100 input100-select">
						{{ session()->get('success') }}
					</div>
				@endif

				<span class="contact100-form-title">
					Add Advert
				</span>

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Company Name</span>

					
					<div>
						@if($company->count() > 0)
							
								<select class="selection-2" wire:model="company_id">
			
									<option>Choose company</option>
									@foreach($company as $name)
									<option value=""></option>
									@endforeach

								</select>		
						@else
						<p>No Company available</p>
						@endif
					</div>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Message</span>
				<textarea wire:model="message" required class="input100 placeholder="Advertisment specifications"></textarea>
					<span class="focus-input100"></span>

					@if ($message)
						<div class="wrap-input100 validate-input">{{$message}}</div>
					@else
						<div class=""> No entry made</div>
					@endif
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Image Preview</span>
						<img id="preview" src="" width="200px" height="200px">
					<span class="focus-input100"></span>
				</div>

				<div>
					
					<input wire:model="image" required type="file" accept="image/*" multiple onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
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

	<div id="dropDownSelect1"></div> --}}