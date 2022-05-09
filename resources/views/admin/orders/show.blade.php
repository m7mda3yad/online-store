@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
            @can('admin')
            @if($order->delivery_id==null)
                    <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.assign') }} {{trans('cruds.delivery') }}</button>
            @else
                @if($order->delivery_type!=1 && $order->delivery_type!=3)
                    <a href="{{route('order.deliveredOrder',$order->id)}}" class="btn btn-block btn-success">{{ trans('cruds.delivered')}}</a>
                @endif
                @if($order->delivery_type!=3 && $order->delivery_type!=1)
                    <a  href="{{route('order.cancelledOrder',$order->id)}}" class="btn btn-block btn-primary">{{ trans('cruds.cancelled')}}</a>
                @endif
            @endif
            @endcan

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.orders') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.id') }}</th>
                                <td>{{$order->id}}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('cruds.customer') }}</th>
                                <td>{{$order->customer->email??""}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.total') }}</th>
                                <td>{{$order->total??""}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.delivery') }}</th>
                                <td>{{$order->delivery->email??""}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.delivery_type') }}</th>
                                <td>{{$order->type_delivery}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.paid_type') }}</th>
                                <td>{{$order->paid_type}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.created_at') }}</th>
                                <td>{{$order->created_at}}</td>
                            </tr>
                        </thead>
                    </table>




                <div class="col-sm-6">
                    <h1>{{ trans('cruds.products') }}</h1>
                        <br>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{trans('cruds.id')}}</th>
                                <th>{{trans('cruds.name')}}</th>
                                <th>{{trans('cruds.price')}}</th>
                                <th>{{trans('cruds.amount')}}</th>
                                <th>{{trans('cruds.filter')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $item)
                            <tr>
                                <td> {{$item->id??''}}</td>
                                <td>
                                     <a href="{{route('products.show',$item->id)}}" >{{ $item->name }}</a>
                                </td>
                                <td>{{ $item->pivot->price??'' }}</td>
                                <td>{{ $item->pivot->amount??'' }}</td>
                                <td>
                                    <div class="row">
                                        @foreach (getFIlterByKey($item->pivot->key) as $filter)
                                        <div class="col-3">
                                            <label class="btn btn-sm btn-outline-black">{{ $filter->name}}</label>
                                        </div>
                                        @endforeach

                                </td>
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
    </div>
</section>


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.delivery') }}</h3>
                    </div>
                    <form action="{{route('orders.assign.delivery')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <label >{{trans('cruds.delivery')}}</label>
                                <select class="form-control select2" name="delivery_id"style="width: 100%;">
                                    @foreach ($deliveries as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                  </select>
                                @error('delivery_id')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('cruds.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('cruds.add') }}</button>
                        </div>
                    </form>
            </div>
        </div>
      </div>
    </div>
</div>


@endsection
