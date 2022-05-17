@extends('layouts.customers_layout')
@section('header')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">My Order</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Contact</p>
            </div>
        </div>
    </div>
@endsection

@section('content')

<div class="container">
<div class="col-12">
<div class="container-fluid pt-12">
    <div class="row px-xl-12">
        <div class="col-lg-12 mb-12">
            <div class="contact-form">
    <table class="table table-bordered table-striped" >
        <thead>
            <tr>
                <th> id</th>
                <td>{{$order->id}}</td>
            </tr>
            <tr>
                <th> date</th>
                <td>{{$order->date}}</td>
            </tr>
            <tr>
                <th> products </th>
                <td>
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>name</th>
                                <th>price</th>
                                <th>amount</th>
                                <th>details</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->products as $item)
                                <tr>
                                    <td> {{ $item->name }}</td>
                                    <td>{{ $item->pivot->price??'' }}</td>
                                    <td>{{ $item->pivot->amount??'' }}</td>
                                    <td>
                                        @isset($item->pivot->key)
                                            @foreach(getFIlterByKey($item->pivot->key) as $filter)
                                                {{$filter->name??''}} -
                                            @endforeach
                                        @endisset


                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                    </table>


                </td>
            </tr>
        </thead>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>

@endsection

@section('scripts')
@endsection
