@extends('backend.master')

@section('content')

<div class="row">

  <div class="col-md-6">
    <h1>Product List</h1>
    @if(checkPermission('product.create'))
    <a class="btn btn-success" href="{{route('product.create')}}">Create new product</a>
    <a class="btn btn-primary" href="{{route('product.export')}}">Export</a>

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
      <th scope="col">#</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Discount</th>
      <th scope="col">Stock</th>
      <th scope="col">Category Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

@endsection

@push('js')


<script type="text/javascript">

  $(function () {

    let table = $('.data-table').DataTable({

        processing: true,

        serverSide: false,

        ajax: "{{ route('ajax.product.data') }}",

        columns: [

            {data: 'id', name: 'id'},

            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},

            {data: 'price', name: 'price',searchable:true},
            {data: 'discount', name: 'discount'},
            {data: 'stock', name: 'stock' ,searchable:false},
            {data: 'category.name', name: 'category.name'},
            

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

    

  });

</script>
@endpush 