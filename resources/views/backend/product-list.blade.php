@extends('backend.master')

@section('content')

<div class="row">

  <div class="col-md-6">
    <h1>Product List</h1>
    @if(checkPermission('product.create'))
    <a class="btn btn-success" href="{{route('product.create')}}">Create new product</a>
    @endif
  </div>

  <div class="col-md-6">
    <form action="{{route('set.alert.stock')}}" method="post" >
      @csrf

      <input value="{{session()->get('alert')}}" name="alert_qty" type="text" class="form-control" placeholder="Enter Stock alert">
      <button class="btn btn-success">Set</button>

    </form>
  </div>


</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Discount</th>
      <th scope="col">Stock</th>
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
      <td>{{$product->discount}}%</td>       
      @if(session()->has('alert') and  (int) session()->get('alert') < $product->stock) 
      <td>{{$product->stock}}</td>
      @else
      <td style="background: red;">{{$product->stock}}</td>
      @endif
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