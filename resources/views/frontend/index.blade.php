@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide relative" data-bs-ride="carousel">
  <div class="carousel-inner relative w-full overflow-hidden">
  @foreach($sliders as $key => $sliderItem)
    <div class="carousel-item {{ $key == 0 ? 'active':'' }} relative float-left w-full">
    @if($sliderItem->image)
      <img src="{{ asset("$sliderItem->image") }}" class="block w-100" alt="Slider"/>
    @endif
      <div class="carousel-caption d-none d-md-block">
                    <div class="custom-carousel-content">
                        <h1>
                            <span>{{ $sliderItem->title }}</span>
                        </h1>
                        <p>
                            {{ $sliderItem->description }}
                        </p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
    </div>
    @endforeach    
  </div>
  <button class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon inline-block bg-no-repeat" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon inline-block bg-no-repeat" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>Welcome to Summer Ecom</h4>
                <div class="underline mx-auto"></div>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, quo placeat veniam in aliquam porro reprehenderit repellat ullam cum blanditiis aliquid id ducimus amet nobis magni eos, consequatur eius architecto!
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores impedit reiciendis velit alias veritatis, laboriosam dolor quis beatae eum enim sequi, culpa, sit cum quibusdam doloremque ex assumenda similique commodi?
                </p>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Trending Products</h4>
        <div class="underline mb-4"></div>
      </div>
      @if($trendingProducts)
        <div class="col-md-12">
            <div class="owl-carousel owl-theme four-carousel">
              @foreach($trendingProducts as $productItem)
                <div class="item">
                  <div class="product-card">
                      <div class="product-card-img">
                          <label class="stock bg-primary">New</label>

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
              @endforeach
            </div>
        </div>
      @else  
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Available</h4>
            </div>
        </div>
    @endif
    </div>
  </div>
</div>

<div class="py-5 bg-white">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>New Arrivals
          <a href="{{ url('/new-arrivals') }}" class="btn btn-primary btn-sm float-end">view more</a>
        </h4>
        <div class="underline mb-4"></div>
      </div>
      @if($newArrivalProducts)
        <div class="col-md-12">
            <div class="owl-carousel owl-theme four-carousel">
              @foreach($newArrivalProducts as $productItem)
                <div class="item">
                  <div class="product-card">
                      <div class="product-card-img">
                          <label class="stock bg-primary">New</label>

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
              @endforeach
            </div>
        </div>
      @else  
        <div class="col-md-12">
            <div class="p-2">
                <h4>No New Arrivals Available</h4>
            </div>
        </div>
    @endif
    </div>
  </div>
</div>

<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Featured Products
          <a href="{{ url('/featured-products') }}" class="btn btn-primary btn-sm float-end">view more</a>
        </h4>
        <div class="underline mb-4"></div>
      </div>
      @if($featuredProducts)
        <div class="col-md-12">
            <div class="owl-carousel owl-theme four-carousel">
              @foreach($featuredProducts as $productItem)
                <div class="item">
                  <div class="product-card">
                      <div class="product-card-img">
                          <label class="stock bg-primary">New</label>

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
              @endforeach
            </div>
        </div>
      @else  
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Featured Products Available</h4>
            </div>
        </div>
    @endif
    </div>
  </div>
</div>

@endsection

@section('script')
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
@endsection