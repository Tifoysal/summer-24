@extends('backend.master')


@section('content')
<h1>Customer List</h1>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($customers as $customerData)
      
   
    <tr>
      <th scope="row">{{$customerData->id}}</th>
      <td>{{$customerData->name}}</td>
      <td>{{$customerData->email}}</td>
      <td>{{$customerData->mobile}}</td>
      <td>
        <a href="">View</a>
        <a href="">Delete</a>
      </td>
    </tr>

    @endforeach
    
  </tbody>
</table>

{{ $customers->links() }}

@endsection