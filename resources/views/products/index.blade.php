@extends('layouts.app')

@section('title')
    Products
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h3>Products</h3>
        <div class="container mx-5">
            <div class="row">
                @forelse($products as $product)

                <div class="col-md-3">
                    <div class="wsk-cp-product">
                        <div class="wsk-cp-img">
                            <img src="{{ $product->image_url }}" alt="Product" class="img-responsive" />
                        </div>
                        <div class="wsk-cp-text">
                            <div class="category">
                                <span>Category</span>
                            </div>
                            <div class="title-product">
                                <h3>{{ $product->title }}</h3>
                            </div>
                            <div class="description-prod">
                                <p>{{ $product->description }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="wcf-left"><span class="price">BDT {{ $product->price }}</span></div>
                                <div class="wcf-right d-flex">
                                    <form action="{{ route('carts.store') }}" method="POST">
                                        @csrf
                                        <input type="text"  name="product" value="{{ $product->hash_id }}" hidden>
                                        <input type="number"  name="productPrice" value="{{ $product->price }}" hidden>
                                        <button type="submit" class="buy-btn border-none">
                                            <img src="https://cdn4.vectorstock.com/i/1000x1000/00/48/shopping-cart-icon-vector-26520048.jpg" width="30" height="20" alt="">
                                        </button>
                                    </form>
                                   
                                    <a href="" class="buy-btn"> <img src="https://img.favpng.com/18/24/4/font-awesome-computer-icons-eye-pterygium-symbol-png-favpng-5GfQVJ46MPn5hyFZWqLz7dWaa.jpg" width="30" height="20" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty

                <h5>Product does not exis. Please run the seeder class to see the product</h5>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection