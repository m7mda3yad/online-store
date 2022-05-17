<div>
    <style>
        .AgeRange { width: 30%; margin-bottom: 20px; } .pl2 { padding-left: 10px; } .AgeNum { position: relative; display: block; text-align: center; } .AgeRangeLabel { margin: 10px 0; color:#0b867a; } .AgeRangeDiv { border: 1px solid $ee; background: $ff; padding: 3px 5px 5px 12px; border-radius: 4px; } .ranges-container { display: flex; } .ranges-container .range { width: 50%; } .ranges-container .range input[type="range"] { width: 100%; } input[type="range"] { overflow: hidden; margin: auto; -webkit-appearance: none; position: relative; height: 20px; width: 400px; cursor: pointer; } input[type="range"]:focus { outline: none; } .left::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: 100vw 0 0 100vw lightblue; } .right::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; background: #ddd; border: 1px solid black; box-shadow: -100vw 0 0 100vw lightblue; }
    </style>
    <script>
        function changeCount(id)
        {
            document.getElementById("count_array").value=id;
            document.getElementById("count_array").innerHTML=id;
        }
    </script>

    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-12">
                <div class="border-bottom mb-4 pb-4">
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
                        <div class="border-bottom mb-4 pb-4">
                            <h5 class="font-weight-semi-bold mb-4">Filter by {{ $filter->name }}</h5>
                            @foreach ($filter->sub_filters as $subfilter)
                            @if(in_array($subfilter->id,$ids))
                                <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-control-input" wire:click="filte({{$subfilter->id}})" id="{{$subfilter->id}}" name="{{$subfilter->id}}">
                                    <label class="custom-control-label" for="color-5">{{ $subfilter->name }}</label>
                                    <span class="badge border font-weight-normal">{{$subfilter->products->count()  }}</span>
                                </div>
                            @endif
                            @endforeach
                        </div>
                    @endforeach
                @endif

            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{ $product->photo?? asset('assets/img/default.jpg') }}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>$ {{ $product->real_price }}</h6>
                                        <h6 class="text-muted ml-2">
                                            <del>$ {{ $product->price }}</del>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{route('product.show',$product->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    @if(!isset(session()->get('cart', [])[$product->id]))
                                        <a href="{{route('product.show',$product->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    @else
                                        <a wire:click="remove({{$product->id}})" class="btn btn-sm text-danger p-0 " onclick="changeCount({{count(session()->get('cart', []))-1}})">remove</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
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
</div>
