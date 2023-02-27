@extends('layouts.app')

@section('title','Cart List')

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse($cart as $cartItem)
                            @if($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('/collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug) }}">
                                                <label class="product-name">
                                                    @if($cartItem->product->productImages)
                                                        <img src="{{ asset($cartItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px" alt="{{ $cartItem->product->name }}">
                                                    @else
                                                        <img src=" " style="width: 50px; height: 50px" alt="{{ $cartItem->product->name }}">
                                                    @endif
                                                    {{ $cartItem->product->name }}
                                                    @if($cartItem->productColor)
                                                        @if($cartItem->productColor->color)
                                                            <span>- Color: {{ $cartItem->productColor->color->name }}</span>
                                                        @endif    
                                                    @endif
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{ $cartItem->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-2 col-7 my-auto">
                                            <div class="quantity">
                                                <div class="input-group">
                                                    <span class="btn btn1" onclick="decrementQuantity({{$cartItem->id}})"><i class="fa fa-minus"></i></span>
                                                    <input type="text" value="{{ $cartItem->quantity }}" readonly class="input-quantity" data-item-id="{{ $cartItem->id }}" />
                                                    <span class="btn btn1" onclick="incrementQuantity({{$cartItem->id}})"><i class="fa fa-plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 my-auto">
                                            <label class="price">${{ $cartItem->product->selling_price * $cartItem->quantity }} </label>
                                            @php $totalPrice += $cartItem->product->selling_price * $cartItem->quantity @endphp
                                        </div>
                                        <div class="col-md-2 col-5 my-auto">
                                            <div class="remove">
                                                <button type="button" id="cart-{{$cartItem->id}}" onclick="removefromCart({{ $cartItem->id }})" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif    
                        @empty
                            <div>No Cart Items Available</div>
                        @endforelse
                         
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h5>
                        Get the best deals & Offers <a href="{{ url('/collections') }}">shop now</a>
                    </h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span class="float-end">${{ $totalPrice }}</span>
                        </h4>
                        <hr>
                        <a href="{{ url('/checkout') }}" class="btn btn-warning w-100">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
function decrementQuantity(itemId) {
    var inputElement = $("input[data-item-id='" + itemId + "']");
    var currentQuantity = parseInt(inputElement.val());
    if (currentQuantity > 1) {
      inputElement.val(currentQuantity - 1);
      updateQuantityInDb(itemId, currentQuantity - 1);
    }
  }

  function incrementQuantity(itemId) {
    var inputElement = $("input[data-item-id='" + itemId + "']");
    var currentQuantity = parseInt(inputElement.val());
    inputElement.val(currentQuantity + 1);
    updateQuantityInDb(itemId, currentQuantity + 1);
  }

function updateQuantityInDb(itemId, quantity) {
  $.ajax({
    type: "POST",
    url: `/update-cart-quantity/${itemId}`,
    data: { 
        'quantity': quantity ,
        '_token': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
                setTimeout(function(){
                    alertify.set('notifier','position', 'top-right');
                    alertify.message(response.message);
                    cartCount();
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }, 1000);
            },
            error: function(response) {
                setTimeout(function(){
                    alertify.set('notifier','position', 'top-right');
                    alertify.warning(response.responseJSON.message);
                }, 1000);
            }
  });
}

function removefromCart(cartItemId){
        var button = document.getElementById('cart-'+cartItemId);
        button.innerHTML = '<i class="fa fa-trash"></i> Removing...';
        $.ajax({
            url: "/remove-cart",
            type: 'DELETE',
            data: {
                'id' : cartItemId,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                setTimeout(function(){
                    button.innerHTML = '<i class="fa fa-trash"></i> Remove';
                    alertify.set('notifier','position', 'top-right');
                    alertify.message(response.message);
                    setTimeout(function(){
                        location.reload();
                    },1000);
                },1000);
            }
        });
    }
</script>
@endsection






