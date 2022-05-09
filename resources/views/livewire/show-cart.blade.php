<div class="container px-4 px-lg-5 mt-5" >
    <div class="container">
        @php $total = 0 @endphp
        <div class="container">
        <form action="{{ route('checkout') }}" class="text-right">
            <div class="row">
                <div class="col-8">
                    <br>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['product']['real_price'] * $details['quantity'] @endphp
                            <div class="row"  data-id="{{ $id }}" style="background-color:white">
                                <div class="col-8">
                                    <img src="{{ $details['photo']??'' }}" width="100" height="100" class="img-responsive"/>
                                    <br>
                                    <br>
                                    <h1>{{ $details['product']['name'] }}</h1>
                                </div>
                                <div class="col-4" >
                                    <h5 data-th="Price">${{ $details['product']['real_price'] }}</h5>
                                    <h5 data-th="Quantity">
                                        <input class="col-3 btn-sm" type="button" value="+" wire:click="plus({{$id}})">
                                        <input class="col-3 btn-sm" type="button" value="{{ $details['quantity'] }}" />
                                        <input class="col-3 btn-sm" type="button" value="-" wire:click="minus({{$id}})">
                                    </h5>
                                    <h5 data-th="Subtotal" class="text-center">${{ $details['product']['real_price'] * $details['quantity'] }}</h5>
                                    <h5 class="actions" data-th="">
                                        @isset($details['key'])
                                            @foreach(getFIlterByKey($details['key']) as $filter)
                                                <p >{{$filter->name??''}} </p>
                                            @endforeach
                                        @endisset
                                        <br>
                                <button wire:click="remove({{$id}})" class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>

                                    </h5>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @endif
                </div>
                <div class="col-4">
                    <div class="">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <h3><strong>Total ${{ $total }}</strong></h3>
                            </li>
                            <li class="list-group-item">
                                    <button type="submit" class="btn btn-success">Checkout</button>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['product']['real_price'] * $details['quantity'] @endphp
                    <tr data-id="{{ $id }}">
                        <td data-th="Product">

                            <div class="row">
                                <div class="btn-sm-3 hidden-xs"><img src="{{ $details['photo']??'' }}" width="100" height="100" class="img-responsive"/></div>
                                <div class="btn-sm-9">
                                    <h4 class="nomargin">
                                    {{ $details['product']['name'] }}
                                    </h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{ $details['product']['real_price'] }}</td>
                        <td data-th="Quantity">
                            {{--  <select name="name" id="">
                                @for ($i = 0; $i < $details['amount']; $i++)
                                     <option>{{  $i+1 }}</option>
                                @endfor
                             </select>  --}}
                            <input class="col-3" type="button" value="+" wire:click="plus({{$id}})">
                            <input class="col-3" type="button" value="{{ $details['quantity'] }}" />
                            <input class="col-3" type="button" value="-" wire:click="minus({{$id}})">
                        </td>
                        <td data-th="Subtotal" class="text-center">${{ $details['product']['real_price'] * $details['quantity'] }}</td>
                        <td class="actions" data-th="">
                    <button wire:click="remove({{$id}})" class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
            </tr>
            <tr>

                <td colspan="5" class="text-right">
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                        @if(session('cart'))
                    <form action="{{ route('checkout') }}">
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </form>
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>
</div>
