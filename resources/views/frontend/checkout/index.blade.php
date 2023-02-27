@extends('layouts.app')

@section('title','Checkout')

@section('content')

    <div class="py-3 py-md-4 checkout">
        <div class="container">
        @if(session('message'))
                <div class="alert alert-danger">{{ session('message')}}</div>
        @endif

            <h4>Checkout</h4>
            <hr>

            @if($totalProductAmount == 0)
            <div class="card card-body shadow text-center p-md-5">
                <h4>No items in cart to checkout</h4>
                <a href="{{ url('/collections') }}" class="btn btn-warning">Shop now</a>
            </div>
            @else
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Item Total Amount :
                            <span class="float-end">${{ $totalProductAmount }}</span>
                        </h4>
                        <hr>
                        <small>* Items will be delivered in 3 - 5 days.</small>
                        <br/>
                        <small>* Tax and other charges are included ?</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>

                        <form action="{{ url('/place-order') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" value="{{ Auth::user()->name }}" placeholder="Enter Full Name" />
                                    <small class="text-danger fullname"></small>
                                    @error('fullname') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" />
                                    <small class="text-danger phone"></small>
                                    @error('phone') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" placeholder="Enter Email Address" />
                                    <small class="text-danger email"></small>
                                    @error('email') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin-code (Zip-code)</label>
                                    <input type="number" name="pincode" class="form-control" id="pincode" placeholder="Enter Pin-code" />
                                    <small class="text-danger pincode"></small>
                                    @error('pincode') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                                    <small class="text-danger address"></small>
                                    @error('address') <small class="text-danger">{{$message}}</small>  @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                            <button class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>Cash on Delivery Mode</h6>
                                                <hr/>
                                                <button type="button" class="btn btn-primary">Place Order (Cash on Delivery)</button>

                                            </div>
                                            <div class="tab-pane active  fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment Mode</h6>
                                                <hr/>
                                                <!-- <button type="button" class="btn btn-warning">Pay Now (Online Payment)</button> -->
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            @endif
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=Abgs1I10B24aVRQkG6MduFBql08h5sXp8HTzNqy-dgLBEDl3YsfbwYBA9ViZjRBDIHO2Cdfa_nUq5kOL&currency=USD"></script>
<script>
    $(document).ready(function() {
//   $("#cashOnDeliveryTab button").click(function() {
//     $("form").submit();
//   });
$("#cashOnDeliveryTab button").click(function(event) {
    event.preventDefault();
    var button = $(this);
    button.text("Placeing Order..."); // Change the text to "Loading..."

    setTimeout(function() {
      $("form").submit();
      button.text("Place Order (Cash on Delivery)"); // Change the text back to "Submit"
    }, 1000);
  });
});

</script>

<script>
    paypal.Buttons({
        onClick: function()  {
            var fullname = $('#fullname').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val();
            if(fullname.length == 0){
                $('.fullname').text("The name field is required");
            }
            if(email.length == 0){
                $('.email').text("The email field is required");
            }
            if(phone.length == 0){
                $('.phone').text("The phone field is required");
            }else if(phone.length < 10 || phone.length > 11){
                $('.phone').text("Phone number should be between 10 and 11 characters");
                return false;
            }
            if(pincode.length == 0){
                $('.pincode').text("The pincode field is required");
            }else if(pincode.length != 6){
                $('.pincode').text("Pincode should be 6 characters long");
                return false;
            }
            if(address.length == 0){
                $('.address').text("The address field is required");
            }
            if(fullname.length == 0 || email.length == 0 || phone.length == 0 || pincode.length == 0 || address.length == 0){
                return false;
            }
        },
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '0.1'//"{{ $totalProductAmount }}" // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          const transaction = orderData.purchase_units[0].payments.captures[0];
            if(transaction.status == "COMPLETED"){
                var fullname = $('#fullname').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var pincode = $('#pincode').val();
                var address = $('#address').val();

                var data = {
                    'fullname' : fullname,
                    'email' : email,
                    'phone' : phone,
                    'pincode' : pincode,
                    'address' : address,
                    'status_message' : "in progress",
                    'payment_mode' : "Paid by PayPal",
                    'payment_id' : transaction.id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    method: "POST",
                    url: "/paid-online-order",
                    data:data,
                    success:function(response){
                        window.location.href = '/thank-you';
                    },
                    error: function(response) {
                        setTimeout(function(){
                            alertify.set('notifier','position', 'top-right');
                            alertify.warning(response.responseJSON.message);
                        }, 1000);
                    }
                });
            }

          //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
          
        });
      }
    }).render('#paypal-button-container');
  </script>
  @endsection
