@extends('frontend.master')


@section('content')

<section class="h-100">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="fw-normal mb-0">Shopping Cart</h1>
          <div>
           
          </div>
        </div>

        @foreach ($myCart as $cartData)

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"> {{ $cartData['product_name'] }} </p>
                <p><span class="text-muted">Price: </span> {{$cartData['price']}}</p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                  <i class="fas fa-minus"></i>
                </button>

                <input id="form1" min="0" name="quantity" value="{{$cartData['quantity']}}" type="number"
                  class="form-control form-control-sm" />

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                  onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                  <i class="fas fa-plus"></i>
                </button>
              </div>
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0"> {{ $cartData['subtotal'] }}  </h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="btn btn-danger text-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>

        @endforeach
        <hr>
       

        <div class="">
            
          <div class="">
          <p>Total: {{array_sum(array_column(session()->get('basket'),'subtotal'))}} BDT</p>
            <a  class="btn btn-warning btn-block btn-lg">Proceed to Pay</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection