@extends('layouts.mail')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-sm-12 col-md-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button><img src="" alt="logo">
                <h1><center><span class="glyphicon glyphicon-info-sign"></span>
                 <strong>Account activation code</strong></center></h1>
                <hr class="message-inner-separator">
                <p><h2>Hey,</h2></p>
                <br>
                <h4>
                	</h4><p>
                		Please enter the code to activate your account
                	</p><br>
                	<p>
                		Your code is <h2>{{$code}}</h2><br><br>Thank you for registering with us
                	</p>
            	
            </div>
        </div>     
    </div>
</div>
@endsection