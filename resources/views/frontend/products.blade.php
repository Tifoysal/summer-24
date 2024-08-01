@extends('frontend.master')


@section('content')

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">

    @foreach ($products as $prod )
       
   <a href="{{route('show.product',$prod->id)}}">
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card text-black">
          <img src="{{url('/uploads/'.$prod->image)}}"
            class="card-img-top" alt="iPhone" style="width: 200px; height:200px;" />
          <div class="card-body">
            <div class="text-center mt-1">
              <h4 class="card-title">{{$prod->name}}</h4>
              
            </div>

            <div class="text-center">
              <div class="p-3 mx-n3 mb-4" style="background-color: #eff1f2;">
                <h5 class="mb-0">Fashion</h5>
              </div>
              
              <div class="d-flex flex-column mb-4 lead">
                <span class="mb-2">{{$prod->price}} BDT</span>
                
                <span style="color: transparent;">0</span>
              </div>
            </div>

            <div class="d-flex flex-row">
              <a href="{{route('add.to.cart',$prod->id)}}" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary flex-fill me-1" data-mdb-ripple-color="dark">
                Add to cart
              </a>
              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger flex-fill ms-1">Buy now</button>
            </div>

          </div>
        </div>
      </div>

      </a>
      @endforeach
    
    </div>
  </div>
</section>

@endsection