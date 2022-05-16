<div>
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <img src="{{asset('homes/images/p1.png')}}" alt="">
        </div>
        <div class="col-sm-4 col-md-4 col-lg-4">
            <h1>{{ $product->name }}</h1>
            <h1>{{ $price??$product->real_price }}</h1>
            {{--  <a href="#" data-value="XL" class="XL picked" data-select-index="5">XL</a>  --}}
            <form method="get" action="{{route('addToCart')}}">
                <input type="hidden" name="product_id" value="{{$product->id}}">
                    @foreach ($filters as $key=>$item)
                            {{ $item['name'] }}
                        <br/>
                        <div class="row">
                            @foreach ($item['sub_filters'] as $sub)
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <label class="btn btn-default btn-sm btn-block btn-outline-success">{{ $sub->name??""}}
                                    @if(count($filters_id)>0 && !in_array($sub->id,$filters_id) && $sub->filter->id !=$selectedFilter)
                                        <input disabled wire:click="subFilter({{$sub->id}})" class="btn btn-sm btn-primary"type="radio"name="{{$key+1}}">
                                    @else
                                        <input  value="{{$sub->id}}" name="subFilter[{{$key}}]" required wire:click="subFilter({{$sub->id}})" class="btn btn-sm btn-primary"type="radio"name="{{$key+1}}">
                                    @endif
                                    {{--  wire:click="sub({{ $key }},{{ $sub->id }})"  --}}
                                </label>
                            </div>
                            @endforeach
                        </div>

                            <br/>
                    @endforeach
                    <br/>
                @if(!isset(session()->get('cart', [])[$product->id]))
                    <button  class="option2" role="button" >Add to cart</button>
                    {{--  onclick="changeCount({{count(session()->get('cart', []))+1}})" wire:click="add({{$product->id}})"  --}}
                @endif
            </form>
            @if(isset(session()->get('cart', [])[$product->id]))
                <button onclick="changeCount({{count(session()->get('cart', []))-1}})" wire:click="remove({{$product->id}})" class="option2" role="button">remove</button>
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
