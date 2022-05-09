


<div class="row">
    <style>
    .AgeRange { width: 30%; margin-bottom: 20px; } .pl2 { padding-left: 10px; } .AgeNum { position: relative; display: block; text-align: center; } .AgeRangeLabel { margin: 10px 0; color:#0b867a; } .AgeRangeDiv { border: 1px solid $ee; background: $ff; padding: 3px 5px 5px 12px; border-radius: 4px; } .ranges-container { display: flex; } .ranges-container .range { width: 50%; } .ranges-container .range input[type="range"] { width: 100%; } input[type="range"] { overflow: hidden; margin: auto; -webkit-appearance: none; position: relative; height: 20px; width: 400px; cursor: pointer; } input[type="range"]:focus { outline: none; } .left::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: 100vw 0 0 100vw lightblue; } .right::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: -100vw 0 0 100vw lightblue; }
    </style>
        <div class=" col-12">
            <div id="filters" class="button-group col-12">
                {{--  @foreach($categories  as $category)
                    @foreach($category->sub_categories  as $item)
                        @if($item->products->count()>0)
                            <button class="btn btn-primary" wire:click="subCategory({{$item->id}})"data-filter=".high">{{ $item->name }}</button>
                        @endif
                    @endforeach
                @endforeach  --}}
                <br/>
                <hr>
                <div class="form-group row">
                @if(count($ids)>0)
                <div class="col-3">
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
                {{--  <div class="col-3">
                    <label for="vol">Volume (between {{$min}} and {{$max}}):</label>
                    <input type="range"  wire:model="my_price" id="vol" wire:model="my_price" name="vol" min="{{$min}}" max="{{$max}}">
                        <h1>{{ $my_price }}</h1>
                </div>  --}}
                    @foreach ($sub_category->filters as $filter)
                        <div class="col-3">
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
        @foreach($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-4">
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
        <script>
            function changeCount(id)
            {
                document.getElementById("count_array").value=id;
                document.getElementById("count_array").innerHTML=id;
            }
        </script>
    </div>
    {{--
        @isset(session()->get('cart', [])[$product->id])
        <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="btn btn-danger btn-block text-center" role="button">remove</button>
        @else
            <button onclick="changeCount({{count(session()->get('cart', []))+1}})" wire:click="add({{$product->id}})" class="btn btn-primary btn-block text-center" role="button">Add to cart</button>
        @endisset
    --}}

    </div>
