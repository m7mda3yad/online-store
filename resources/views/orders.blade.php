@extends('layouts.customers_layout')
@section('header')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">My Orders</h1>
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
<div class="">
<div class="container-fluid pt-12">
    <div class="row px-xl-12">
        <div class="col-lg-12 mb-12">
            <div class="contact-form">

    <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Number</th>
                <th>Count</th>
                <th>Date</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach(auth()->guard('customer')->user()->orders as $item)
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{$item->products->count() }}</td>
                    <td>{{$item->date }}</td>
                    <td>{{$item->type_delivery }}</td>
                    <td><a class="" href="{{ route('order.show',$item->id) }}"> Show</a></td>
                </tr>
            @endforeach

            </tbody>
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
