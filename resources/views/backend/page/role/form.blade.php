@extends('backend.master')


@section('content')
<h1>Role Form</h1>



<form action="{{route('admin.role.store')}}" method="post">
@csrf
  <div class="form-group">
    <label for="name">Enter Role Name</label>
    <input name="name" required type="text" class="form-control" id="name" placeholder="Enter Category Name">
  </div>



  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection