@extends('layouts.customer_layout')
@section('content')

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

@endsection

@section('scripts')
@endsection
