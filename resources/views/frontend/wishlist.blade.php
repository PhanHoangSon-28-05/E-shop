@extends('layouts.front')

@section('title')
    Wishlist
@endsection

@section('content')
    <div class="py-3 mb-4 shadpw-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home
                </a> /
                <a href="{{ url('wishlist') }}">
                    Wishlist
                </a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/upload/products/' . $item->products->image) }}" height="70px"
                                    width="70px" alt="Img here">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h6>{{ $item->products->name }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>Rs {{ $item->products->selling_price }}</h6>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if ($item->products->qty >= $item->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="witdh:130px">
                                        <button class="input-group-text decrement-btn">-</button>
                                        <input type="text" name="quantity" id=""
                                            class="form-control qty-input text-center" value="1">
                                        <button class="input-group-text increment-btn">+</button>
                                    </div>
                                    <h6>In Stock</h6>
                                @else
                                    <h6>Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-success addToCarBtn"><i class="fa fa-shopping-cart">Add to
                                        Cart</i></button>
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-wishlist-item"><i
                                        class="fa fa-trash">Remove</i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>There are no products in your Wishlist</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
