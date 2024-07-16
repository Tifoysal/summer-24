@extends('backend.master')

@section('content')

<h1>Product List</h1>

<a class="btn btn-success" href="{{route('product.create')}}">Create new product</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>

  @foreach ($allProduct as $product)
  <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->price}} BDT</td>
      <td>
        <a href="">View</a>
      </td>
    </tr>
  @endforeach
    
    
  </tbody>
</table>

{{ $allProduct->links() }}
@endsection