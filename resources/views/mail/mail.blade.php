@extends('layouts.mail')
@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-sm-12 col-md-12">
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button><img src="" alt="logo">
                <h1><center><span class="glyphicon glyphicon-info-sign"></span>
                 <strong>Password Reset Code</strong></center></h1>
                <hr class="message-inner-separator">
                <p><h2>Hey, {{$name}}</h2></p>
                <br>
                <h4>
                	</h4><p>
                		Password reset request received. Please enter the following code in the application to reset your password
                	</p><br>
                	<p>
                		Your code is <h2>{{$code}}</h2><br><br>Thank you
                	</p>
            	
            </div>
        </div>     
    </div>
</div>
@endsection