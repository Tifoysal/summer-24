@extends('backend.master')

@section('content')

<h1>Product List</h1>

<a class="btn btn-success" href="{{route('product.create')}}">Create new product</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Category Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  @foreach ($allProduct as $key=>$product)
  <tr>
      <th scope="row">{{$key+1}}</th>
      <td>
        <img src="{{url('/uploads/'.$product->image)}}" alt="" width="60">
      </td>
      <td>{{$product->name}}</td>
      <td>{{$product->price}} BDT</td>
      <td>{{$product->category->name}}</td>
      <td>
        <a href="{{route('product.view',$product->id)}}" class="btn btn-primary">View</a>
        <a href="{{route('product.edit',$product->id)}}" class="btn btn-success">Edit</a>
        <a href="{{route('product.delete',$product->id)}}" class="btn btn-danger">Delete</a>
      </td>
    </tr>
  @endforeach
    
    
  </tbody>
</table>

{{ $allProduct->links() }}
@endsection