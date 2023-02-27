@extends('layouts.app')

@section('title','Wishlist')

@section('content')

    <div class="py-3 py-md-5 ">
        <div class="container">
            <h3>My Wishlist</h3>
            <hr>

            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-4">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlist as $wishlistItem)
                            @if($wishlistItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <a href="{{ url('/collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug) }}">
                                                <label class="product-name">
                                                    <img src="{{ $wishlistItem->product->productImages[0]->image }}" style="width: 50px; height: 50px" alt="{{ $wishlistItem->product->name }}">
                                                      {{ $wishlistItem->product->name }}
                                                </label>
                                            </a>
                                        </div>
                                        <div class="col-md-2 my-auto">
                                            <label class="price">${{ $wishlistItem->product->selling_price }} </label>
                                        </div>
                                        <div class="col-md-4 col-12 my-auto">
                                            <div class="remove">
                                                <button type="button" id="wishlist-{{$wishlistItem->id}}" onclick="removefromWishlist({{$wishlistItem->id}})" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h4>No Wishlist Added</h4>
                        @endforelse
                       
                                
                    </div>
                </div>
            </div>

        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    function removefromWishlist(wishlistId){
        var button = document.getElementById('wishlist-'+wishlistId);
        button.innerHTML = '<i class="fa fa-trash"></i> Removing...';
        $.ajax({
            url: "/remove-wishlist",
            type: 'DELETE',
            data: {
                'id' : wishlistId,
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
