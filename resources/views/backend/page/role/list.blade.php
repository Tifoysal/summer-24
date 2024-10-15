@extends('backend.master')

@section('content')

<h1>Category List</h1>

<!-- <button type="button" class="btn btn-primary">Primary</button> -->
<a class="btn btn-primary" href="{{route('admin.role.form')}}">Create Role</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
      
      <th scope="col">Status</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>

@foreach ($roles as $role)
 
<tr>
      <th scope="row">{{$role->id}}</th>
      <td>{{$role->name}}</td>
    
      <td>{{$role->status}}</td>
      <td>
        <a class="btn btn-success" href="{{route('admin.permission',$role->id)}}">Assign Permission</a>
        <a class="btn btn-info" href="">Edit</a>
        <a class="btn btn-danger" href="{{route('admin.role.delete',$role->id)}}">Delete</a>
      </td>
    </tr>

@endforeach
   

    
  </tbody>
</table>

{{ $roles->links() }}

@endsection