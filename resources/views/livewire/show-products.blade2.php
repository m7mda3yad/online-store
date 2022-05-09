<div class="section">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            @foreach($categories  as $category)
                                @foreach($category->sub_categories  as $item)
                                <li>
                                    <button class="btn btn-primary" wire:click="subCategory({{$item->id}})"data-filter=".high">{{ $item->name }}</button>
                                </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div>
                            <div class="products-slick">
                                @foreach($products as $product)
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="{{$product->photo??asset('indexPage/img/product05.png')}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Category</p>
                                            <h3 class="product-name"><a href="#">{{ $product->name}}</a></h3>
                                            <h4 class="product-price">${{ $product->real_price }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                            {{--  <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>  --}}
                                            <div class="product-btns">
                                                @if(auth()->guard('customer')->check())
                                                    @if (in_array($product->id,auth()->guard('customer')->user()->favorite_ids))
                                                    <a  class="add-to-wishlist" wire:click="unfavorite({{$product->id}})"><span class="glyphicon glyphicon-heart"></span></a>
                                                            @else
                                                        <a  class="add-to-wishlist" wire:click="favorite({{$product->id}})"><i class="fa fa-heart-o"></i></a>
                                                    @endif
                                                @else
                                                    <a  class="add-to-wishlist" href="{{route('customer.login.form')}}" ><i class="fa fa-heart-o"></i></a>
                                                    @endif
                                                <a  class="quick-view" href="{{route('product.show',$product->id)}}"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                                @isset(session()->get('cart', [])[$product->id])
                                                    <a class="add-to-cart-btn" onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="option2" role="button">remove</a>
                                                        @else
                                                        <a  href="{{route('product.show',$product->id)}}" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</a>
                                                @endisset
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="slick-nav-{{$item->id}}" class="products-slick-nav"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function changeCount(id)
        {
            document.getElementById("count_array").value=id;
            document.getElementById("count_array").innerHTML=id;
        }
    </script>
