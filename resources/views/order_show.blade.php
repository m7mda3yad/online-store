@extends('layouts.customer_layout')
@section('content')
<div class="container">
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

@endsection

@section('scripts')
@endsection
