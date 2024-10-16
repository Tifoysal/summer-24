@extends('backend.master')


@section('content')
<h1>User Create Form</h1>



<form action="{{route('users.store')}}" method="post">
@csrf
  <div class="form-group">
    <label for="name">Enter User Name</label>
    <input name="name" required type="text" class="form-control" id="name" placeholder="Enter Category Name">
  </div>

  <div class="form-group">
    <label for="email">Enter User Email</label>
    <input name="email" required type="text" class="form-control" id="email" placeholder="Enter Category Name">
  </div>

  <div class="form-group">
    <label for="password">Enter User password</label>
    <input name="password" required type="text" class="form-control" id="password" placeholder="Enter Category Name">
  </div>

  <div class="form-group">
    <label for="c_password">Enter User confirm password</label>
    <input name="password_confirmation" required type="text" class="form-control" id="c_password" placeholder="Enter Category Name">
  </div>


  <div class="form-group">
    <label for="role">Select Role</label>

    <select class="form-control" name="role_id" id="">

    @foreach($roles as $role)
      <option value="{{$role->id}}">
        {{$role->name}}
      </option>
      @endforeach
    </select>



  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection