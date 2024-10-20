<style>
  .no-padding {
    padding: 0px;
  }

  .glyphicon-icon-rpad .glyphicon,
  .glyphicon-icon-rpad .glyphicon.m8,
  .fa-icon-rpad .fa,
  .fa-icon-rpad .fa.m8 {
    padding-right: 8px;
  }

  .glyphicon-icon-lpad .glyphicon,
  .glyphicon-icon-lpad .glyphicon.m8,
  .fa-icon-lpad .fa,
  .fa-icon-lpad .fa.m8 {
    padding-left: 8px;
  }

  .glyphicon-icon-rpad .glyphicon.m5,
  .fa-icon-rpad .fa.m5 {
    padding-right: 5px;
  }

  .glyphicon-icon-lpad .glyphicon.m5,
  .fa-icon-lpad .fa.m5 {
    padding-left: 5px;
  }

  .glyphicon-icon-rpad .glyphicon.m12,
  .fa-icon-rpad .fa.m12 {
    padding-right: 12px;
  }

  .glyphicon-icon-lpad .glyphicon.m12,
  .fa-icon-lpad .fa.m12 {
    padding-left: 12px;
  }

  .glyphicon-icon-rpad .glyphicon.m15,
  .fa-icon-rpad .fa.m15 {
    padding-right: 15px;
  }

  .glyphicon-icon-lpad .glyphicon.m15,
  .fa-icon-lpad .fa.m15 {
    padding-left: 15px;
  }



  ul.nav-menu-list-style .nav-header .menu-collapsible-icon {
    position: absolute;
    right: 3px;
    top: 16px;
    font-size: 9px;
  }



  ul.nav-menu-list-style {
    margin: 0;
  }

  ul.nav-menu-list-style .nav-header {
    border-top: 1px solid #FFFFFF;
    border-bottom: 1px solid #e8e8e8;
    display: block;
    margin: 0;
    line-height: 42px;
    padding: 0 8px;
    font-weight: 600;
  }

  ul.nav-menu-list-style>li {
    position: relative;
  }

  ul.nav-menu-list-style>li a {
    border-top: 1px solid #FFFFFF;
    border-bottom: 1px solid #e8e8e8;
    padding: 0 10px;
    line-height: 32px;
  }

  ul.nav-menu-list-style>li:first-child a {}


  ul.nav-menu-list-style {
    list-style: none;
    padding: 0px;
    margin: 0px;
  }

  ul.nav-menu-list-style li .badge,
  ul.nav-menu-list-style li .pull-right,
  ul.nav-menu-list-style li span.badge,
  ul.nav-menu-list-style li label.badge {
    float: right;
    margin-top: 7px;
  }

  ul.bullets {
    list-style: inside disc
  }

  ul.numerics {
    list-style: inside decimal
  }

  .ul.kas-icon-aero {}

  ul.kas-icon-aero li a:before {
    font-family: 'Glyphicons Halflings';
    font-size: 9px;
    content: "\e258";
    padding-right: 8px;
  }
</style>
<script href="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<div class="top-bar">

  <div class="container">

    <div class="row">

      <div class="col-md-6">

        <div class="social pull-left">

          <ul>

            <li><a href=""><i class="fa fa-facebook"></i></a></li>

            <li><a href=""><i class="fa fa-twitter"></i></a></li>

            <li><a href=""><i class="fa fa-google-plus"></i></a></li>

            <li><a href=""><i class="fa fa-linkedin"></i></a></li>

          </ul>

        </div>

      </div>

      <div class="col-md-6">

        <div class="action pull-right">

          <ul>

            @guest('customerGuard')
            <li>
              <!-- Button trigger modal -->
              <a type="" class="" data-toggle="modal" data-target="#loginModal">
                Login
              </a>
            </li>

            <li>

              <!-- Button trigger modal -->
              <a type="" class="" data-toggle="modal" data-target="#exampleModal">
                Register
              </a>
            </li>
            @endguest

            @auth('customerGuard')
            <li>
              <!-- Button trigger modal -->
              <a href="{{route('view.profile')}}" class="">
                {{ auth('customerGuard')->user()->name }}
              </a>
            </li>

            <li>
              <!-- Button trigger modal -->
              <a href="{{route('customer.logout')}}" class="">
                Logout
              </a>
            </li>

            @endauth

            <li>

              @php
              if(auth('customerGuard')->check())
              {
              $wishList=\App\Models\Wishlist::where('customer_id',auth('customerGuard')->user()->id)->count();
              }else{
              $wishList=0;
              }


              @endphp


              <div>
                <a class="btn" href="">
                  <svg fill="red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M12 4.435c-1.989-5.399-12-4.597-12 3.568 0 4.068 3.06 9.481 12 14.997 8.94-5.516 12-10.929 12-14.997 0-8.118-10-8.999-12-3.568z" />
                  </svg>
                  ({{$wishList}})

                </a>
              </div>

            </li>

            <li>
              <select onchange="location = this.options[this.selectedIndex].value;" name="" id="" class="form-control">
                <option @if(session()->get('locale')=='bn') selected @endif value="{{route('change.lang','bn')}}">Bangla
                </option>
                <option @if(session()->get('locale')=='en') selected @endif value="{{route('change.lang','en')}}">English
                </option>
                <option @if(session()->get('locale')=='ar') selected @endif value="{{route('change.lang','ar')}}">Arabic
                </option>
              </select>
            </li>
          </ul>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="header">

  <div class="container">

    <div class="row">

      <div class="col-md-3 col-sm-4">

        <div class="logo">

          <a href="index.html">

            <img src="{{url('/uploads/logo/')}}" alt="Orani E-shop">

          </a>

        </div>

      </div>

      <div class="col-md-7 col-sm-5">

        <div class="search-form">

          <form class="navbar-form" role="search" action="{{route('search')}}">

            <div class="form-group">

              <input name="search_key" value="{{request()->search_key}}" type="text" class="form-control" placeholder="{{__('Search here')}}">

            </div>

            <button type="submit" class="btn"><i class="fa fa-search"></i></button>

          </form>

        </div>

      </div>

      <div class="col-md-2 col-sm-3">

        <div class="cart">

          <div class="cart-icon">

            <a href="{{route('view.cart')}}">
              <i class="fa fa-shopping-cart"></i>
            </a>

          </div>

          <div class="cart-text">

            SHOPPING CART

            <br>

            <!-- @php 
            if(session()->has('basket')){
                echo count(session()->get('basket'));
            }else{
                echo 0;
            }
            @endphp -->

            <!-- @if (session()->has('basket'))

            {{ count(session()->get('basket')) }} 

            @else
            0
            @endif -->

            <!-- ternary operator -->

            <!-- (condition) ? if block : else block -->
            @if(session()->has('basket'))

            {{ count(session()->get('basket')) }} item(s) - {{ array_sum(array_column(session()->get('basket'),'subtotal')) }}

            @else

            0 item(s)

            @endif


          </div>


        </div>

      </div>


    </div>


  </div>

</div>

<div class="navigation">

  <nav class="navbar navbar-theme">

    <div class="container">

      <!-- Brand and toggle get grouped for better mobile display -->

      <div class="navbar-header">

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">

          <span class="sr-only">Menu</span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

        </button>

      </div>

      <div class="shop-category nav navbar-nav navbar-left">

        <!-- Single button -->

        <div class="btn-group">

          <button type="button" class="btn btn-shop-category dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            {{__('SHOP BY CATEGORY')}} <span class="caret"></span>

          </button>

         
         

          <script>
            $('.tree-toggle').click(function() {
              $(this).parent().children('ul.tree').toggle(200);
            });
            $(function() {
              $('.tree-toggle').parent().children('ul.tree').toggle(200);
            })
          </script>

        </div>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->

      <div class="collapse navbar-collapse" id="navbar">

        <ul class="nav navbar-nav navbar-right">

          <li><a href="#">Home</a></li>

          <li><a href="#">Blog</a></li>

          <li>
            <a href="{{route('frontend.products')}}">All Products</a>
          </li>

          <li><a href="#">Features</a></li>

          <li><a href="#">Media</a></li>

          <li><a href="#">About Us</a></li>

          <li><a href="#">Contact Us</a></li>

        </ul>

      </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->

  </nav>

</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Customer Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{route('customer.registration')}}" method="post">
        @csrf
        <div class="modal-body">
          <div>
            <label for="">Enter your name:</label>
            <input required type="text" name="customer_name" placeholder="Enter your name" class="form-control">
          </div>

          <div>
            <label for="">Enter your email:</label>
            <input required type="email" name="email" placeholder="Enter your email" class="form-control">
          </div>

          <div>
            <label for="">Enter your password:</label>
            <input required type="password" name="password" placeholder="Enter your password" class="form-control">
          </div>


          <div>
            <label for="">Retype your password:</label>
            <input required type="password" name="password_confirmation" placeholder="Retype your password" class="form-control">
          </div>

          <div>
            <label for="">Enter your Mobile Number:</label>
            <input required type="text" name="mobile_number" placeholder="Enter your Mobile number" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Register Now</button>
        </div>
      </form>


    </div>
  </div>
</div>


<!-- login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Customer Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{route('customer.login')}}" method="post">
        @csrf
        <div class="modal-body">


          <div>
            <label for="">Enter your email:</label>
            <input required type="email" name="email" placeholder="Enter your email" class="form-control">
          </div>

          <div>
            <label for="">Enter your password:</label>
            <input required type="password" name="password" placeholder="Enter your password" class="form-control">
          </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Register Now</button>
        </div>
      </form>


    </div>
  </div>
</div>