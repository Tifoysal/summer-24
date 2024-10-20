@extends('frontend.master')

@section('content')

<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<h1>Enter OTP to verify your account.</h1>
		
		<!-- Login Form -->
		<form action="{{route('otp.submit')}}" method="post">
			@csrf
			<input type="number" id="otp" class="fadeIn second form-control" name="otp" placeholder="Enter OTP">
			<a href="">Resend OTP</a>
			<input type="submit" class="btn btn-success active" style="margin: 5px;" value="Log In">
			</form>
	</div>
</div>
</div>
</div>
</div>



@endsection