
@extends('frontend.master')

@section('content')

<div class="container">
  
<form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

        <div>

        <img style="width: 300px;" src="{{url('/uploads/customers/'.auth('customerGuard')->user()->image)}}" alt="tat">

        </div>

          <div>
            <label for="">Enter your name:</label>
            <input value="{{auth('customerGuard')->user()->name}}" required type="text" name="customer_name" placeholder="Enter your name" class="form-control">
          </div>

          <div>
            <label for="">Enter your email:</label>
            <input disabled type="email" name="email" value="{{auth('customerGuard')->user()->email}}" placeholder="Enter your email" class="form-control">
          </div>

          <div>
            <label for="">Upload Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>

      </div>
@endsection