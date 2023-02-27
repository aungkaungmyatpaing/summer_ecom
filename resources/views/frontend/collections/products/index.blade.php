@extends('layouts.app')

@section('title')
    {{ $category->meta_title }}
@endsection

@section('meta_keyword')
    {{ $category->meta_keyword }}
@endsection

@section('meta_description')
    {{ $category->meta_description }}
@endsection

@section('content')

<div class="py-3 py-md-5 ">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Products</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        @if($category->brands)
                       <div class="card">
                            <div class="card-header">
                                <h4>Brands</h4>
                            </div>
                            <div class="card-body">
                                @foreach($category->brands as $brandItem)
                                <label class="d-block">
                                    @if($filtered_brand == $brandItem->name)
                                    <input type="checkbox" class="brand_defilter" value="{{ $brandItem->name }}" checked /> {{ $brandItem->name }}
                                    @else
                                    <input type="checkbox" class="brand_filter" value="{{ $brandItem->name }}" /> {{ $brandItem->name }}
                                    @endif
                                </label>
                                @endforeach
                            </div>
                       </div>
                       @endif

                       <!-- <div class="card mt-3">
                            <div class="card-header">
                                <h4>Price</h4>
                            </div>
                            <div class="card-body">
                                <label class="d-block">
                                    <input type="checkbox" class="price_filter" value="low_high" onchange="filterProducts()" /> Low to High
                                <label class="d-block">
                                    <input type="checkbox" class="price_filter" value="high_low" onchange="filterProducts()" /> High to Low                                
                                </label>
                            </div>
                       </div> -->

                    </div>
                    <div class="col-md-9">  
                        <div class="row">
                            @forelse($products as $productItem)
                            <div class="col-md-4">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        @if($productItem->quantity > 0)
                                        <label class="stock bg-success">In Stock</label>
                                        @else
                                        <label class="stock bg-danger">Out of Stock</label>
                                        @endif

                                        @if($productItem->productImages->count() > 0)
                                        <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                            <img src="{{ asset($productItem->productImages[0]->image) }}" alt="{{ $productItem->name }}">
                                        </a>    
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem->brand }}</p>
                                        <h5 class="product-name">
                                        <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                                {{ $productItem->name }}
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">${{ $productItem->selling_price }}</span>
                                            <span class="original-price">${{ $productItem->original_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-md-12">
                                <div class="p-2">
                                    <h4>No Products Available for {{ $category->name }}</h4>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script>
    var categorySlug = "<?php echo $category->slug; ?>";
    $(document).ready(function(){
        $(".brand_filter").on("change", function(){
            window.location.href = "/collections/" + categorySlug + "?brand=" + this.value;
        });
        

        $(".brand_defilter").on("change", function(){
            window.location.href="/collections/" + categorySlug;
        });
    });
</script>
@endsection


