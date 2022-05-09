@extends('layouts.customer_layout')
@section('content')
<div class="row">
    <div class="col-md-10" style="margin-left: 7%">
        <div class="row">
            <div class="products-tabs">
                @php($flag=0)
                    <h1 style="margin: auto; width: 40%;"> Favorites</h1>
                <div>
                    <div class="products-slick" data-nav="#slick-nav-favorites">
                        @foreach (auth()->guard('customer')->user()->favorites as $product)
                        <div class="product">
                                <div class="product-img">
                                    <img src="{{$product->photo??asset('indexPage/img/product05.png')}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Category</p>
                                    <h3 class="product-name"><a href="#">{{ $product->name}}</a></h3>
                                    <h4 class="product-price">${{ $product->real_price }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product-btns">
                                        <a class="add-to-wishlist" href="{{ route('product.favorite',$product->id) }}"><i class="fa fa-heart-o"></i><span class="tooltipp"></span></a>
                                        <a class="quick-view" href="{{ route('product.show',$product->id) }}"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <a class="add-to-cart-btn" href="{{ route('product.show',$product->id) }}"><i class="fa fa-shopping-cart"></i> View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="slick-nav-favorites" class="products-slick-nav"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
