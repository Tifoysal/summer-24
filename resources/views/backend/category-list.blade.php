@extends('backend.master')

@section('content')

<style>
  *{
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-o-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
}
.tree-structure{
	list-style: none;
	clear: both;
	padding-left: 15px;
}
.tree-structure li {
	position: relative;
}
.tree-structure li a{
	font-weight: normal;
	color: red;
	text-decoration: none;
	font-weight: 700;
	vertical-align: middle;
	-webkit-transition: all 0.5s ease-in-out;
	-moz-transition: all 0.5s ease-in-out;
	-ms-transition: all 0.5s ease-in-out;
	-o-transition: all 0.5s ease-in-out;
	transition: all 0.2s ease-in-out;
	display: inline-block;
	max-width: calc(100% - 50px);
	vertical-align: top;
}
.tree-structure li a:hover{
	padding-left: 5px;
}
.tree-structure > li > .num{
	display: inline-block;
	background: #333;
	min-width: 24px;
	padding-left: 0px;
	padding-right: 0px;
	text-align: center;
	padding: 3px 9px;
	margin-right: 10px;
	color: #fff;
	font-weight: 700;
	font-size: 12px;
}
.tree-structure > li > .num:after{
	position: absolute;
	content: "";
	width: 1px;
	height: 100%;
	background-color: #939393;
	top: 5px;
	left: 12px;
	z-index: -1;
}
.tree-structure > li:last-child > .num:after{	
	height: calc(100% - 44px);
}
.tree-structure ol{
	padding: 20px 0 20px 45px;
}
.tree-structure ol li{
	list-style-type: none;
	padding: 8px 0
}
.tree-structure ol li .num{
	position: relative;
}
.tree-structure ol li a{
	color: #000;
	font-weight: normal;
}
.tree-structure .num{
	background-color: #666;
	min-width: 24px;
	padding-left: 0px;
	padding-right: 0px;
	text-align: center;
	padding: 3px 9px;
	margin-right: 10px;
	color: #fff;
	font-weight: 700;
	font-size: 12px;
	display: inline-block;
	vertical-align: middle;
}
.tree-structure  ol  li .num:before{
	position: absolute;
	content: "";
	top: 0;
	bottom: 0;
	right: 100%;
	margin: auto;
	width: 33px;
	height: 1px;
	background-color: #939393;
}
</style>

<h1>Category List</h1>

<!-- <button type="button" class="btn btn-primary">Primary</button> -->
<a class="btn btn-primary" href="{{route('category.form')}}">Create Category</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
      <th scope="col">Category Parent</th>
      <th scope="col">Category Slug</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>

@foreach ($allCategory as $cat)
 
<tr>
      <th scope="row">{{$cat->id}}</th>
      <td>{{$cat->name}}</td>
      <td>{{optional($cat->parent)->name}}</td>
      <!-- <td>{{is_null($cat->parent) ? 'null' : $cat->parent->name}}</td> -->
      <td>{{$cat->slug}}</td>
      <td>{{$cat->description}}</td>
      <td>{{$cat->status}}</td>
      <td>
        <a class="btn btn-success" href="">View</a>
        <a class="btn btn-info" href="">Edit</a>
        <a class="btn btn-danger" href="{{route('category.delete',$cat->id)}}">Delete</a>
      </td>
    </tr>

@endforeach
   

    
  </tbody>
</table>

{{ $allCategory->links() }}

<hr>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		    <ol class="tree-structure">


          @foreach($parents as $parent)
          
              <li>
                 <span class="num"></span>
                 <a href="#">{{$parent->name}}</a>
                 
                 <!-- child block -->
                
                 @if(count($parent->child)>0)

                  @include('backend.partials.child',['parent'=>$parent])

                 @endif


              </li>
              @endforeach
             
           </ol>
		</div>
	</div>
</div>

@endsection