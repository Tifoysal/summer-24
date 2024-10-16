@extends('backend.master')

@section('content')

<a class="btn btn-info" href="{{route('users.create')}}">Create New User</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role Name</th>
      <th scope="col">Phone Number</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allUser as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role->name}}</td>
      <td>{{$user->mobile}}</td>
    </tr>
    @endforeach
    
  </tbody>

</table>


@endsection



