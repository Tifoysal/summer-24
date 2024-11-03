@extends('frontend.master')

@section('content')

<style>
    body {
    margin: 0;
    padding-top: 40px;
    color: #2e323c;
    background: #f5f6fa;
    position: relative;
    height: 100%;
    }
    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }
    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }
    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }
    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }
    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }
    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }
    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }
    .account-settings .about p {
        font-size: 0.825rem;
    }
    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: .825rem;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }


</style>

<div class="container">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<img src="" alt="user image">
				</div>
				<h5 class="user-name">Name: {{auth('customerGuard')->user()->name}}</h5>
				<h6 class="user-email">Email: {{auth('customerGuard')->user()->email}}</h6>
			</div>
			<div class="about">
        <a href="{{route('edit.profile')}}" class="btn btn-success">Edit profile</a>
				<h5>Mobile</h5>
				<p>{{auth('customerGuard')->user()->mobile}}</p>
			</div>
		</div>
	</div>
</div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		
<h1>My Orders ({{ $orders->count() }})</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Order Number</th>
      <th scope="col">Receiver Name</th>
      <th scope="col">Total Price</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
    <tr>
      <th scope="row">{{$order->id}}</th>
      <th scope="row">{{$order->receiver_name}}</th>
      <td>{{$order->total_amount}}</td>
      <td>{{$order->status}}</td>
      <td>
        <a class="btn btn-success" href="{{route('view.invoice',$order->id)}}">View Order</a>
        @if($order->status=='pending')
        <a class="btn btn-danger" href="{{route('cancel.order',$order->id)}}">Cancel Order</a>
        @endif
      </td>
    </tr>
    @endforeach
    
   
  </tbody>
</table>

	</div>
</div>
</div>
</div>
</div>



@endsection