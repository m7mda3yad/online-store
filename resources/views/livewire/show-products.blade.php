<div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div id="aside" class="col-3 col-sm-3 col-md-3 col-lg-3" >

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="AgeRangeDiv">
                            <div class="AgeRangeLabel">Price Range</div>
                            <div class="ranges-container">
                                <div class="range">
                                <input type="range" min="0"  wire:model="my_price"  max="{{($max/2)+2}}" label="Min" value="39" class="AgeRange left">
                                <span class="AgeNum">
                                    <span class="text-mute">Min</span>
                                    <span class="text-success text-bold pl2">{{$my_price}}</span>
                                </span>
                                </div>
                                <div class="range">
                                <input type="range" min="{{($max/2)+2}}"  wire:model="max_price"  max="{{$max+1}}" label="Max" value="" class="AgeRange right">
                                <span class="AgeNum">
                                    <span class="text-mute">Max</span>
                                    <span class="text-success text-bold pl2">{{$max_price}}</span>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(count($ids)>0)
                        @foreach ($sub_category->filters as $filter)
                        <div class="aside">
                            <h3 class="aside-title">{{ $filter->name }}</h3>
                            @foreach ($filter->sub_filters as $subfilter)
                            @if(in_array($subfilter->id,$ids))
                                <div class="checkbox-filter">
                                    <div>
                                        {{--  wire:model="filterId"  --}}
                                        <input type="checkbox" wire:click="filte({{$subfilter->id}})" id="{{$subfilter->id}}" name="{{$subfilter->id}}">
                                        <label>
                                           {{$subfilter->name}}{{--  <small>(120)</small>  --}}</label>
                                    </div>
                                </div>
                            @else
                            @endif
                            @endforeach
                        </div>
                        @endforeach
                    @endif

                </div>
                <div id="store" class="col-9 col-sm-9 col-md-9 col-lg-9" style="  border-left: 1px solid black">
                    <div class="row">

                        @foreach($products as $product)

                        <div class="col-md-4 col-xs-6" style="padding: 4%">
                            <div class="product">
                                <div class="product-img"><img src="{{ $product->photo??asset('homes/images/p1.png')}}" alt=""></div>
                                <div class="product-body">
                                    <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
                                    <h4 class="product-price">{{ $product->real_price }} <del class="product-old-price">${{ $product->price }}</del></h4>
                                    <div class="product-rating">
                                    </div>
                                    <div class="product-btns">
                                        <a class="add-to-wishlist" href="{{ route('product.favorite',$product->id) }}"><i class="fa fa-heart-o"></i><span class="tooltipp"></span></a>
                                        <a class="quick-view" href="{{ route('product.show',$product->id) }}"><i class="fa fa-eye"></i><span class="tooltipp"></span></a>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    @isset(session()->get('cart', [])[$product->id])
                                    <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="add-to-cart-btn" role="button">remove</button>
                                    @else
                                    <a href="{{route('product.show',$product->id)}}" class="add-to-cart-btn" role="button">Add To Cart</a>
                                    @endisset
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
<div class="row">
    <style>
        .AgeRange { width: 30%; margin-bottom: 20px; } .pl2 { padding-left: 10px; } .AgeNum { position: relative; display: block; text-align: center; } .AgeRangeLabel { margin: 10px 0; color:#0b867a; } .AgeRangeDiv { border: 1px solid $ee; background: $ff; padding: 3px 5px 5px 12px; border-radius: 4px; } .ranges-container { display: flex; } .ranges-container .range { width: 50%; } .ranges-container .range input[type="range"] { width: 100%; } input[type="range"] { overflow: hidden; margin: auto; -webkit-appearance: none; position: relative; height: 20px; width: 400px; cursor: pointer; } input[type="range"]:focus { outline: none; } .left::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: 100vw 0 0 100vw lightblue; } .right::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: -100vw 0 0 100vw lightblue; }
    </style>

    <div class="col-3 col-sm-3 col-md-3 col-lg-3 ">
        <div id="filters" class="button-group">
            <br/>
            <hr>
            <div class="form-group ">
                @if(count($ids)>0)
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="AgeRangeDiv">
                            <div class="AgeRangeLabel">Price Range</div>
                            <div class="ranges-container">
                                <div class="range">
                                <input type="range" min="0"  wire:model="my_price"  max="{{($max/2)+2}}" label="Min" value="39" class="AgeRange left">
                                <span class="AgeNum">
                                    <span class="text-mute">Min</span>
                                    <span class="text-success text-bold pl2">{{$my_price}}</span>
                                </span>
                                </div>
                                <div class="range">
                                <input type="range" min="{{($max/2)+2}}"  wire:model="max_price"  max="{{$max+1}}" label="Max" value="" class="AgeRange right">
                                <span class="AgeNum">
                                    <span class="text-mute">Max</span>
                                    <span class="text-success text-bold pl2">{{$max_price}}</span>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($sub_category->filters as $filter)
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <label >{{ $filter->name }}</label>
                            <select class="form-control" wire:model="filterId" label="filterId" >
                                <option value="">filter</option>
                                @foreach ($filter->sub_filters as $subfilter)
                                    @if(in_array($subfilter->id,$ids))
                                        <option value="{{$subfilter->id}}" >{{$subfilter->name}}</option>
                                    @else
                                        <option disabled >{{$subfilter->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-9 col-sm-9 col-md-9 col-lg-9">
        @foreach($products as $product)
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{route('product.show',$product->id)}}" class="option1">
                            {{ $product->name }}
                            </a>
                            @isset(session()->get('cart', [])[$product->id])
                            <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="option2" role="button">remove</button>
                                @else
                                <a href="{{route('product.show',$product->id)}}" class="option2" role="button">Add To Cart</a>
                            @endisset
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{ $product->photo??asset('homes/images/p1.png')}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $product->name }}
                        </h5>
                        <h6>
                            $ {{ $product->real_price }}
                        </h6>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        function changeCount(id)
        {
            document.getElementById("count_array").value=id;
            document.getElementById("count_array").innerHTML=id;
        }
    </script>
</div>
</div>
