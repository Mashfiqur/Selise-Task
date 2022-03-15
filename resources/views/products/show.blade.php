@extends('layouts.app')

@section('title')
Products | {{ $product->title }}
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h3>{{ $product->title }}</h3>
        <div class="container mx-5">
            <div class="row">
                @isset($product)

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
                                <div class="wcf-right"><a href="#" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>

                @endisset
            </div>
        </div>
    </div>
</div>
@endsection