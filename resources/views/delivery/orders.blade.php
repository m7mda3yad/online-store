@extends('layouts.delivery')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ trans('cruds.orders') }}</h1>
            <br>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger ">{{$error}}</div>
                    @endforeach
                @endif
            </div>

        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.orders') }}</li>
          </ol>
        </div>
      </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{trans('cruds.id')}}</th>
                        <th>{{trans('cruds.customer')}}</th>
                        <th>{{trans('cruds.delivery_type')}}</th>
                        <th>{{trans('cruds.products')}}</th>
                        <th>{{ trans('cruds.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td> {{$item->id??''}}</td>
                            <td> {{$item->customer->email??''}}</td>
                            <td> {{$item->type_delivery??''}}</td>
                            <td> {{$item->products->count()??''}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('orders.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>{{trans('cruds.id')}}</th>
                        <th>{{trans('cruds.customer')}}</th>
                        <th>{{trans('cruds.delivery_type')}}</th>
                        <th>{{trans('cruds.products')}}</th>
                        <th>{{ trans('cruds.action') }}</th>
                    </tr>
                </tfoot>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>
  @endsection
