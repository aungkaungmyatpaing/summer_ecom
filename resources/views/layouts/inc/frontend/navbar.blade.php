<div class="main-navbar shadow-sm sticky-top">
        <div class="top-navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                        <h2 class="brand-name">
                            <span style="color: #ffd900;">Summer</span>
                            <span>Ecom</span>
                        </h2>
                    </div>
                    <div class="col-md-5 my-auto">
                        <form action="{{ url('search') }}" method="GET" role="search">
                            <div class="input-group">
                                <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search your product" class="form-control" />
                                <button class="btn bg-white" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 my-auto">
                        <ul class="nav justify-content-end">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('cart') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart ( <span class="cart-count">0</span> )
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('wishlist') }}">
                                    <i class="fa fa-heart"></i> Wishlist ( <span class="wishlist-count">0</span> ) 
                                </a>
                            </li>
                            @if (Route::has('login'))
                                    @auth
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-user"></i> {{ Auth::user()->name }} 
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ url('profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                                        <li><a class="dropdown-item" href="{{ url('orders') }}"><i class="fa fa-list"></i> My Orders</a></li>
                                        <li><a class="dropdown-item" href="{{ url('wishlist') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                        <li><a class="dropdown-item" href="{{ url('cart') }}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                        <li>
                                            <a class="dropdown-item" href="route('logout')"
                                                        onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i> {{ __('Log Out') }}
                                            </a>
                                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                        </ul>
                                    </li>                
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa fa-sign-in"></i> Log In 
                                        </a>
                                    </li>
                                        @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">
                                                <i class="fa fa-id-card"></i> Register 
                                            </a>
                                        </li>
                                        @endif
                                    @endauth
                            @endif
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                    Funda Ecom
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/collections') }}">All Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/new-arrivals') }}">New Arrivals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/featured-products') }}">Featured Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Electronics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Fashions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accessories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        wishlistCount();
        cartCount();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    function wishlistCount(){
        $.ajax({
            method:"GET",
            url:"/nav-wishlist",
            success: function(response){
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.count);
            }
        });
    }
    function cartCount(){
        $.ajax({
            method:"GET",
            url:"/nav-cart",
            success: function(response){
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }
</script>
