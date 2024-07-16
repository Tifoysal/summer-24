@extends('backend.master')

@section('content')

<h1>Create new product</h1>


<form action="{{route('product.store')}}" method="post">
    @csrf
  <div class="form-group">
    <label for="p_name">Enter Product name:</label>
    <input name="product_name" type="text" class="form-control" id="p_name"  placeholder="Enter product name">
  </div>


  <div class="form-group">
    <label for="p_price">Enter Product price:</label>
    <input name="product_price" type="text" class="form-control" id="p_price"  placeholder="Enter product price">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection