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


<table class="data-table">
  <thead>
    <tr>
      
      <th scope="col">Category Name</th>
     
    </tr>
  </thead>
  <tbody>
@foreach($data as $p)
  <tr>
    <td>{{$p->category->name}}</td>
  </tr>

  @endforeach
  </tbody>
</table>

@endsection