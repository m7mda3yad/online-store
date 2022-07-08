    <div class="container-fluid py-5">
        @php($data=getFilterId($product->id))
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{$product->photo?? asset('assets/img/product-1.jpg') }}" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('assets/img/product-2.jpg') }}" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('assets/img/product-3.jpg') }}" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="{{ asset('assets/img/product-4.jpg') }}" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">$ {{ $price??$product->real_price  }}</h3>
                <p class="mb-4">{{ $product->description }}</p>
                <form wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                @foreach ($filters as $key=>$item)
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">{{$item['name'] }} : </p>
                    @foreach ($item['sub_filters'] as $sub)
                    <div class="custom-control custom-radio custom-control-inline">
                        @if(count($filters_id)>0 && !in_array($sub->id,$filters_id) && $sub->filter->id !=$selectedFilter)
                        <input disabled wire:click="subFilter({{$sub->id}})" class="custom-control-input"  id="{{ $sub->id }}" type="radio" name="{{$key+1}}">
                        @else
                        <input {{ in_array($sub->id , $data )?'checked':''}}  required name="subFilter[{{$key}}]"   required wire:click="subFilter({{$sub->id}})"
                                class="custom-control-input" value="{{$sub->id}}" id="{{$sub->id}}" type="radio">
                        @endif
                            <label class="custom-control-label" for="{{ $sub->id }}">{{ $sub->name }}</label>
                    </div>
                    @endforeach
                </div>
                @endforeach

                @if(!isset(session()->get('cart', [])[$product->id]))
                <div class="d-flex align-items-center mb-4 pt-2">
                    {{--    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>  --}}
                    <button type="button'" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
            </form>
                @else
                <div class="d-flex align-items-center mb-4 pt-2">
                    <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="btn btn-danger px-3">remove</button>
                </div>
                    @endif



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





