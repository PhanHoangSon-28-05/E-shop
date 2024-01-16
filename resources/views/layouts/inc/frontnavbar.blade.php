<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a>
        <div class="search-bar">
            <form action="{{url('searchproduct')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control" id="search_product" name="product_name" placeholder="Search products"  aria-describedby="basic-addon1">
                    <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('category') }}">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('cart') }}">Cart
                        <span class="badge badge-pill bg-primary cart-count">0</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('wishlist') }}">Wishlist
                        <span class="badge badge-pill bg-success wishlist-count">0</span></a></a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a href="{{ url('my-orders') }}" class="dropdown-item">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">
                                    My profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>
<script src="{{ asset('fontend/js/bootstrap.bundle.js') }}"></script>
