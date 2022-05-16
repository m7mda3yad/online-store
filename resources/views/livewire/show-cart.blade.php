<div class="container-fluid pt-5">
    @php $total = 0 @endphp
    <form action="{{ route('checkout') }}">
    <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                @if(session('cart'))
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    @foreach(session('cart') as $id => $details)
                    @php $total += $details['product']['real_price'] * $details['quantity'] @endphp
                    <tr data-id="{{ $id }}">
                            <td class="align-middle"><img src="{{$details['photo']??asset('assets/img/product-1.jpg')}}" alt="" style="width: 50px;">{{ $details['product']['name'] }}
                                <br>
                                @isset($details['key'])
                                @foreach(getFIlterByKey($details['key']) as $filter)
                                    {{$filter->name??''}} \
                                @endforeach
                                @endisset
                            </td>
                            <td class="align-middle">$ {{ $details['product']['real_price'] }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">

                                        <button type="button" class="btn btn-sm btn-primary btn-minus" wire:click="minus({{$id}})" ><i class="fa fa-minus"></i></button>

                                    </div>
                                    <input  type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $details['quantity'] }}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-plus" wire:click="plus({{$id}})" ><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" data-th="Subtotal">${{ $details['product']['real_price'] * $details['quantity'] }}</td>
                            <td class="align-middle">
                                <button type="button" wire:click="remove({{$id}})" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$  ${{ $total }}</h5>
                        </div>
                        @if(session('cart'))
                        @if(count(session('cart'))>0)
                         <button type="submit" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
