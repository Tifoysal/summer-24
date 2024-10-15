@extends('backend.master')


@section('content')
<h1>Role Form</h1>



<form action="{{route('admin.permission.assign',$role_id)}}" method="post">
  @csrf
  @foreach($permissions as $p)
  <div class="form-group">
    <label for="">{{$p->name}}</label>
    <input @if(in_array($p->id,$rolePermissions)) checked @endif type="checkbox" name="permission[]" value="{{$p->id}}">
  </div>

  @endforeach


  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection