@extends('backend.master')


@section('content')


<h1>Update product</h1>


<form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="p_name">Enter Product name:</label>
    <input value="{{$product->name}}" required name="product_name" type="text" class="form-control" id="p_name" placeholder="Enter product name">
  </div>

  <div class="form-group">
    <label for="xyz">Select Category Name:</label>
    <select name="category_id" class="form-select" aria-label="Default select example">
      
    @foreach ($allCategory as $category)
    <option value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
     
      
    </select>
  </div>


  <div class="form-group">
    <label for="p_price">Enter Product price:</label>
    <input value="{{$product->price}}" required name="product_price" type="text" class="form-control" id="p_price" placeholder="Enter product price">
  </div>


  <div class="form-group">
    <label for="image">Upload Product Image:</label>
    <input name="product_image" type="file" class="form-control" id="image" placeholder="Upload product image">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>




@endsection