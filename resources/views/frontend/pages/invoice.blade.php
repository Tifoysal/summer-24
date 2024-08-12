@extends('frontend.master')

@section('content')

<div class="container">
<button class="btn btn-success" onClick="printReport()">Print</button>
    
<!-- print area suru -->

    <div class="card" id="printArea">
        <div class="card-header">
            Invoice
            <strong>{{$order->created_at}}</strong>
            <span class="float-right"> <strong>Status:</strong> {{$order->status}}</span>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>Kodeeo Limited</strong>
                    </div>
                    <div></div>
                    <div>House 34,Road 2, Nikunja, Dhaka</div>
                    <div>Email: info@kodeeo.com</div>
                    <div>Phone: +8801854969654</div>
                </div>

                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>{{$order->receiver_name}}</strong>
                    </div>
                 
                    <div>{{$order->receiver_address}}</div>
                    <div>Email: {{ $order->receiver_email }}</div>
                    <div>Phone: {{$order->receiver_mobile}}</div>
                </div>



            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>Item</th>
                          

                            <th class="right">Unit Cost</th>
                            <th class="center">Qty</th>
                            <th class="right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>


                    @foreach ($order->orderDetails as $item)
                        
                        <tr>
                            <td class="center">{{$item->id}}</td>
                            <td class="center"><img style="width: 50px;" src="{{url('/uploads/'.$item->product->image)}}" alt=""></td>
                            <td class="left strong">{{$item->product->name}}</td>
                            <td class="right">{{$item->product_unit_price}}</td>
                            <td class="center">{{$item->product_quantity}}</td>
                            <td class="right">{{$item->subtotal}}</td>
                        </tr>

                        @endforeach
                       
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">

                </div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Subtotal</strong>
                                </td>
                                <td class="right">$8.497,00</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Discount (20%)</strong>
                                </td>
                                <td class="right">$1,699,40</td>
                            </tr>
                          
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>{{$order->total_amount}}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                  

                </div>

            </div>

        </div>
    </div>

    <!-- print area sesh -->
</div>


<script type="text/javascript">
    function printReport()
    {
        var printContents = document.getElementById("printArea").innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
    }
</script>
@endsection