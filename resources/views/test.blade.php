<div>
    <div class="featured-page">
      <div class="container">
        <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="section-heading">
          <div class="line-dec"></div>
          <h1>Featured Items</h1>
          </div>
        </div>
        <div class="col-md-8 col-sm-12">
          <div id="filters" class="button-group">
            @foreach($categories  as $category)
            @foreach($category->sub_categories  as $item)
            @if($item->products->count()>0)
              <button class="btn btn-primary" wire:click="subCategory({{$item->id}})"data-filter=".high">{{ $item->name }}</button>
            @endif
            @endforeach
          @endforeach

          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="featured container no-gutter">
      <div class="row posts">
        @foreach($products as $product)
          <div id="9" class="item new col-md-4">
              <div class="featured-item">
                <img src="{{ asset('home\assets\images\product-01.jpg') }}" alt="">
                <h4>{{ $product->name }}</h4>
                <h6>$ {{ $product->real_price }}</h6>
                @isset(session()->get('cart', [])[$product->id])
                <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="btn btn-danger btn-block text-center" role="button">remove</button>
                @else
                    <button onclick="changeCount({{count(session()->get('cart', []))+1}})" wire:click="add({{$product->id}})" class="btn btn-primary btn-block text-center" role="button">Add to cart</button>
                @endisset

            </div>
          </div>
        @endforeach
      </div>

      <br>
      <br>
      <hr>
    </div>
</div>
<div>
    <header>
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />


        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
                <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    @isset($categories)
                    @foreach($categories  as $category)
                        <a class="list-group-item list-group-item-action py-2 ripple"aria-current="true"data-mdb-toggle="collapse"href="#collapseExample2"aria-expanded="true"aria-controls="collapseExample2">
                            <i class="fas fa-chart-area fa-fw me-3"></i><{{ $category->name }}</span></a>
                            <ul id="collapseExample2" class="collapse list-group list-group-flush">
                                @foreach($category->sub_categories  as $item)
                                @if($item->products->count()>0)
                                    <li class="list-group-item py-1" wire:click="subCategory({{$item->id}})" style="{{ $sub_category->id==$item->id?'color:red':'' }}"><a href="#" class="text-reset">{{ $item->name }} => {{ $item->products->count() }}</a></li>
                                @endif
                                @endforeach
                        </ul>
                    @endforeach
                    @endisset

                    </div>
                </div>
        </nav>
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#">
                <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="25" alt="MDB Logo" loading="lazy" />
                </a>
                <ul class="navbar-nav ms-auto d-flex flex-row">
                <li class="nav-item dropdown">
                    <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-3 me-lg-0" href="#"> <i class="fas fa-fill-drip"></i></a>
                </li>

                <div class="dropdown">
                    <button type="button" class="btn btn-info" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span id="count_array"class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            <div class="col-lg-6 col-sm-6 col-6">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                            </div>
                            @php $total = 0 @endphp
                            @foreach((array) session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="{{$details['photo']}}" />
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ $details['name'] }}</p>
                                        <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{ route('cart') }}" class="btn btn-primary btn-block">View all</a>
                            </div>
                        </div>
                    </div>
                </div>

                </ul>
            </div>
        </nav>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <div class="container">
            <div class="row">
                <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                    <div class="MultiCarousel-inner">
                        @foreach($products as $product)
                            <div class="item">
                                <div class="pad15">
                                    <p class="lead">Multi Item Carousel</p>
                                    <p>₹ 1</p>
                                    <p>₹ 6000</p>
                                    <p>50% off</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <button class="btn btn-primary leftLst"><</button>
                    <button class="btn btn-primary rightLst">></button>
                </div>
            </div>
        </div>
    </header>
    <main style="margin-top: 58px;">
    <div class="container pt-4">

        <div class="row">
            @isset($products)
                @foreach($products as $product)
                    <div class="col-xs-18 col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <img src="{{ $product->photo??'' }}" alt="">
                            <div class="caption">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <p><strong>Price: </strong> {{ $product->price }}$</p>
                                <p class="btn-holder">
                                    @isset(session()->get('cart', [])[$product->id])
                                    <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="btn btn-danger btn-block text-center" role="button">remove</button>
                                    @else
                                        <button onclick="changeCount({{count(session()->get('cart', []))+1}})" wire:click="add({{$product->id}})" class="btn btn-primary btn-block text-center" role="button">Add to cart</button>
                                    @endisset
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset

            @isset($categories)
                @foreach($categories  as $category)
                    @foreach($category->sub_categories  as $item)
                    @if( $item->has('products'))
                        <div class="container">
                            <h3 class="h3">{{$item->name}} </h3>
                            <div class="row">
                                @foreach($item->products  as $product)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="product-grid4">
                                            <div class="product-image4">
                                                <a href="#">
                                                    <img class="pic-1" src="https://www.w3schools.com/bootstrap4/img_avatar4.png">
                                                    <img class="pic-2" src="https://www.w3schools.com/bootstrap4/img_avatar3.png">
                                                </a>
                                                <ul class="social">
                                                    <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                                                    <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                                <span class="product-discount-label">-12%</span>
                                            </div>
                                            <div class="product-content">
                                                <h3 class="title"><a href="#">{{$product->name}}</a></h3>
                                                <div class="price">
                                                    {{$product->real_price}}
                                                    <span>${{$product->real_price}}</span>
                                                </div>
                                                @isset(session()->get('cart', [])[$product->id])
                                                <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="add-to-cart" role="button">remove</button>
                                                @else
                                                    <button onclick="changeCount({{count(session()->get('cart', []))+1}})" wire:click="add({{$product->id}})" class="add-to-cart" role="button">Add to cart</button>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                    @endif
                    @endforeach
                @endforeach
            @endisset

                <script>
            function changeCount(id)
            {
                document.getElementById("count_array").innerHTML=id;
            }
        </script>
        </div>
    </div>
    </main>
</div>
<script>
    $(document).ready(function () {
        var itemsMainDiv = ('.MultiCarousel');
        var itemsDiv = ('.MultiCarousel-inner');
        var itemWidth = "";

        $('.leftLst, .rightLst').click(function () {
            var condition = $(this).hasClass("leftLst");
            if (condition)
                click(0, this);
            else
                click(1, this)
        });

        ResCarouselSize();




        $(window).resize(function () {
            ResCarouselSize();
        });

        //this function define the size of the items
        function ResCarouselSize() {
            var incno = 0;
            var dataItems = ("data-items");
            var itemClass = ('.item');
            var id = 0;
            var btnParentSb = '';
            var itemsSplit = '';
            var sampwidth = $(itemsMainDiv).width();
            var bodyWidth = $('body').width();
            $(itemsDiv).each(function () {
                id = id + 1;
                var itemNumbers = $(this).find(itemClass).length;
                btnParentSb = $(this).parent().attr(dataItems);
                itemsSplit = btnParentSb.split(',');
                $(this).parent().attr("id", "MultiCarousel" + id);


                if (bodyWidth >= 1200) {
                    incno = itemsSplit[3];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 992) {
                    incno = itemsSplit[2];
                    itemWidth = sampwidth / incno;
                }
                else if (bodyWidth >= 768) {
                    incno = itemsSplit[1];
                    itemWidth = sampwidth / incno;
                }
                else {
                    incno = itemsSplit[0];
                    itemWidth = sampwidth / incno;
                }
                $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                $(this).find(itemClass).each(function () {
                    $(this).outerWidth(itemWidth);
                });

                $(".leftLst").addClass("over");
                $(".rightLst").removeClass("over");

            });
        }


        //this function used to move the items
        function ResCarousel(e, el, s) {
            var leftBtn = ('.leftLst');
            var rightBtn = ('.rightLst');
            var translateXval = '';
            var divStyle = $(el + ' ' + itemsDiv).css('transform');
            var values = divStyle.match(/-?[\d\.]+/g);
            var xds = Math.abs(values[4]);
            if (e == 0) {
                translateXval = parseInt(xds) - parseInt(itemWidth * s);
                $(el + ' ' + rightBtn).removeClass("over");

                if (translateXval <= itemWidth / 2) {
                    translateXval = 0;
                    $(el + ' ' + leftBtn).addClass("over");
                }
            }
            else if (e == 1) {
                var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                translateXval = parseInt(xds) + parseInt(itemWidth * s);
                $(el + ' ' + leftBtn).removeClass("over");

                if (translateXval >= itemsCondition - itemWidth / 2) {
                    translateXval = itemsCondition;
                    $(el + ' ' + rightBtn).addClass("over");
                }
            }
            $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
        }

        //It is used to get some elements from btn
        function click(ell, ee) {
            var Parent = "#" + $(ee).parent().attr("id");
            var slide = $(Parent).attr("data-slide");
            ResCarousel(ell, Parent, slide);
        }

    });
</script>
