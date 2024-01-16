@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadpw-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('checkout') }}">
                    Cart
                </a>
            </h6>
        </div>
    </div>
    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <Label for="">First name</Label>
                                    <input type="text" class="form-control firstname" value="{{ Auth::user()->name }}"
                                        name="fname" id="" placeholder="Enter First Name">
                                    <span id="fname_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <Label for="">Last name</Label>
                                    <input type="text" class="form-control lastname" value="{{ Auth::user()->lname }}"
                                        name="lname" id="" placeholder="Enter First Name">
                                    <span id="lname_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <Label for="">Email</Label>
                                    <input type="text" class="form-control email"
                                        value="{{ Auth::user()->email }}"name="email" id=""
                                        placeholder="Enter Email">
                                    <span id="email_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <Label for="">Phone Number</Label>
                                    <input type="text" class="form-control phone"
                                        value="{{ Auth::user()->phone }}"name="phone" id=""
                                        placeholder="Enter Phone Number">
                                    <span id="phone_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <Label for="">Address 1</Label>
                                    <input type="text" class="form-control address1"
                                        value="{{ Auth::user()->address1 }}"name="address1" id=""
                                        placeholder="Enter Address 1">
                                    <span id="address1_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <Label for="">Address 2</Label>
                                    <input type="text" class="form-control address2"
                                        value="{{ Auth::user()->address2 }}"name="address2" id=""
                                        placeholder="Enter Address 2">
                                    <span id="address2_error " class="text-danger"></span>

                                </div>
                                <div class="col-md-6">
                                    <Label for="">City</Label>
                                    <input type="text" class="form-control city"
                                        value="{{ Auth::user()->city }}"name="city" id="" placeholder="Enter City">
                                    <span id="city_error " class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <Label for="">State</Label>
                                    <input type="text" class="form-control state"
                                        value="{{ Auth::user()->state }}"name="state" id=""
                                        placeholder="Enter State">
                                    <span id="state_error " class="text-danger"></span>

                                </div>
                                <div class="col-md-6">
                                    <Label for="">Country</Label>
                                    <input type="text" class="form-control country"
                                        value="{{ Auth::user()->country }}"name="country" id=""
                                        placeholder="Enter Country">
                                    <span id="country_error " class="text-danger"></span>

                                </div>
                                <div class="col-md-6">
                                    <Label for="">Pin code</Label>
                                    <input type="text" class="form-control pincode"
                                        value="{{ Auth::user()->pincode }}"name="pincode" id=""
                                        placeholder="Enter Pin code">
                                    <span id="pincode_error " class="text-danger"></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            @if ($cartitems->count() > 0)
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach ($cartitems as $item)
                                            <tr>
                                                @php
                                                    $total += $item->products->selling_price * $item->prod_qty;
                                                @endphp
                                                <td class="text-wrap w-50">{{ $item->products->name }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Grand Total <span class="float-end">Rs {{ $total }}</span></h6>
                                <hr>
                                <button type="submit" class="btn btn-success w-100">Price Orde | COD</button>
                                <button type="button" class="btn btn-primary w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
                                <div id="paypal-button-container"></div>
                            @else
                                <h4 class="text-center">No product in cart</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AYLrCYa1jnJPxFlNDfc186pZcitgPSGlQrBeA0tEdPd2pjIYVoTnAVjV620XfuN7KjgEfWfTsLK44TSu"></script>

<script>
    // Tạo nút PayPal
    paypal.Buttons({
      createOrder: function(data, actions) {
        // Tạo đơn hàng và trả về ID đơn hàng
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '{{ $total }}' // Số tiền cần capture
            }
          }]
        });
      },
      onApprove: function(data, actions) {
        // Thực hiện capture giao dịch  
        return actions.order.capture().then(function(details) {
            // Capture thành công
            // console.log('Capture thành công:', details);
            // // Thực hiện các hành động khác sau khi capture thành công
            // alert('Translation complete by' + details.payer.name.given_name);

                var firstname= $('.firstname').val();
                var lastname= $('.lastname').val();
                var email= $('.email').val();
                var phone= $('.phone').val();
                var address1= $('.address1').val();
                var address2= $('.address2').val();
                var city= $('.city').val();
                var state= $('.state').val();
                var country= $('.country').val();
                var pincode= $('.pincode').val();

                $.ajax({
                method: "POST",
                url: "/pleace-order",
                data:{
                    'fname':firstname,
                    'lname':lastname,
                    'email':email,
                    'phone':phone,
                    'address1':address1,
                    'address2':address2,
                    'city':city,
                    'state':state,
                    'country':country,
                    'pincode':pincode,
                    'payment_mode':"Paid by to PayPal",
                    'payment_id':details.id,
                },
                success: function(response) {
                    swal(response.status);
                    windown.location.href = "/my-orders"
                }
            });
        });
      }
      
    }).render('#paypal-button-container');
  </script>
@endsection