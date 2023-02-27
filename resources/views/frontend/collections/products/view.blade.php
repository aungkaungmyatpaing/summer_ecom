@extends('layouts.app')

@section('title')
    {{ $product->meta_title }}
@endsection

@section('meta_keyword')
    {{ $product->meta_keyword }}
@endsection

@section('meta_description')
    {{ $product->meta_description }}
@endsection

@section('content')

    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border">
                        @if($product->productImages)
                        <!-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> -->
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach($product->productImages as $itemImg)
                                        <li><img src="{{ asset($itemImg->image) }}"/></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
                        @else
                            No Image Added 
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $product->category->name }} / {{ $product->name }} 
                        </p>
                        <p class="product-path">Brand : {{ $product->brand }}</p>
                        <div>
                            <span class="selling-price">${{ $product->selling_price }}</span>
                            <span class="original-price">${{ $product->original_price }}</span>
                        </div>
                        <div>
                            @if($product->productColors->count() > 0 )
                                @if($product->productColors)
                                    @foreach($product->productColors as $colorItem)
                                        <!-- <input type="radio" name="colorSelection" value="{{$colorItem->id}}"> {{$colorItem->color->name}} -->
                                        <label class="colorSelectionLable" style="background-color: {{$colorItem->color->code}} " onclick="handleColorSelection({{$colorItem->id}})">
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                @endif
                            <div>
                                @if(isset($status) && $status === 'outOfStock')
                                    <label class="btn btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                @elseif(isset($status) && $status === 'inStock')
                                    <label class="btn btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @endif
                            </div>
                            @else
                                @if($product->quantity)
                                    <label class="btn btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                @else
                                    <label class="btn btn-sm py-1 mt-2 text-white bg-danger">Out of Stock</label>
                                @endif    
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" onclick="decrementQuantity()"><i class="fa fa-minus"></i></span>
                                <input type="text" id="quantity-count" value="1" readonly class="input-quantity" />
                                <span class="btn btn1" onclick="incrementQuantity()"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" id="cart" onclick="addToCart({{ $product->id }},colorId)" class="btn btn1">
                                <span>
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </span>
                            </button>
                            <button type="button" id="wishlist" onclick="addToWishlist({{$product->id}})" class="btn btn1">
                                <span>
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Related
                        @if($category){{ $category->name }}@endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if($category)
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach($category->relatedProducts as $relatedProductItem)
                            <div class="item mb-3">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        @if($relatedProductItem->productImages->count() > 0)
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                            <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                        </a>    
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                        <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                {{ $relatedProductItem->name }}
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $relatedProductItem->selling_price }}</span>
                                            <span class="original-price">${{ $relatedProductItem->original_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="p-2">
                            <h4>No Related Products Available</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>
                        Related
                        @if($product){{ $product->brand }}@endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if($category)
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach($category->relatedProducts as $relatedProductItem)
                            @if($relatedProductItem->brand == "$product->brand")
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if($relatedProductItem->productImages->count() > 0)
                                            <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                <img src="{{ asset($relatedProductItem->productImages[0]->image) }}" alt="{{ $relatedProductItem->name }}">
                                            </a>    
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                            <h5 class="product-name">
                                            <a href="{{ url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug) }}">
                                                    {{ $relatedProductItem->name }}
                                            </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price">${{ $relatedProductItem->selling_price }}</span>
                                                <span class="original-price">${{ $relatedProductItem->original_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif    
                        @endforeach
                    </div>    
                    @else
                    <div class="p-2">
                        <h4>No Related Products Available</h4>
                    </div>
                    @endif
                </div>  
            </div>
        </div>
    </div>
   

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


<script>
    var colorId = 0 ;
    var categorySlug = "<?php echo $category->slug; ?>";
    var productSlug = "<?php echo $product->slug; ?>";
    function handleColorSelection(colorId) {
        window.localStorage.setItem("colorId", colorId);
        console.log("handleColorSelection: colorId =", colorId); // Add this line
        window.location.href = '/collections/'+categorySlug+'/'+productSlug+'/'+colorId;
    }
</script>

<script>
        function addToWishlist(productId) {
        var button = document.getElementById('wishlist');
        button.innerHTML = 'Adding...';
        $.ajax({
            url: "/add-wishlist",
            type: 'POST',
            data: { 
                'product_id': productId ,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                setTimeout(function(){
                  button.innerHTML = '<i class="fa fa-heart"></i> Add To Wishlist';
                    alertify.set('notifier','position', 'top-right');
                    alertify.message(response.message);
                    wishlistCount();
                }, 1000);
            },
            error: function(response) {
                setTimeout(function(){
                  button.innerHTML = '<i class="fa fa-heart"></i> Add To Wishlist';
                    alertify.set('notifier','position', 'top-right');
                    alertify.warning(response.responseJSON.message);
                }, 1000);
            }
        });
    }
</script>

<script>
    function decrementQuantity() {
        var currentQuantity = parseInt(document.getElementById("quantity-count").value);
        if(currentQuantity > 1) {
            document.getElementById("quantity-count").value = currentQuantity - 1;
        }
    }

    function incrementQuantity() {
        var currentQuantity = parseInt(document.getElementById("quantity-count").value);
        if(currentQuantity < 10) {
            document.getElementById("quantity-count").value = currentQuantity + 1;
        }
    }
</script>

<script>
    function addToCart(productId){
        var button = document.getElementById('cart');
        button.innerHTML = 'Adding...';
        var quantity = parseInt(document.getElementById("quantity-count").value);
        var color_id = window.localStorage.getItem("colorId");
        console.log("addToCart: color_id =", color_id); // Add this line
        $.ajax({
            url: "/add-cart",
            type: 'POST',
            data: {
                'product_id': productId,
                'color_id' : color_id,
                'quantity': quantity,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                setTimeout(function(){
                    button.innerHTML = '<i class="fa fa-shopping-cart"></i> Add To Cart';
                    alertify.set('notifier','position', 'top-right');
                    alertify.message(response.message);
                    cartCount();
                }, 1000);
            },
            error: function(response) {
                setTimeout(function(){
                    button.innerHTML = '<i class="fa fa-shopping-cart"></i> Add To Cart';
                    alertify.set('notifier','position', 'top-right');
                    alertify.warning(response.responseJSON.message);
                }, 1000);
            }
        });
    }
</script>

@endsection

@push('scripts')
<script>
    $(function(){

    $("#exzoom").exzoom({

    // thumbnail nav options
    "navWidth": 60,
    "navHeight": 60,
    "navItemNum": 5,
    "navItemMargin": 7,
    "navBorder": 1,
    "autoPlay": false,
    "autoPlayTimeout": 2000
    
    });

    });
</script>

<script>
  $('.four-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
  })
</script>
@endpush







