@extends('backend.master')


@section('content')
<h1>Category Form</h1>



<form action="{{route('category.store')}}" method="post">
@csrf
  <div class="form-group">
    <label for="name">Enter Category Name</label>
    <input name="cat_name" type="text" class="form-control" id="name" placeholder="Enter Category Name">
  </div>

  <div class="form-group" style="margin-top: 10px;">
    <label for="name">Enter Description</label>
   <textarea class="form-control" name="cat_description" id="" placeholder="Enter Description"></textarea>
  </div>

  <div class="form-group" style="margin-top: 10px;">
    <label for="name">Uplaod Image</label>
    <input name="cat_image" type="file" class="form-control" id="name" placeholder="Enter Category Name">
  </div>



  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection