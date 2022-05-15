@extends('layouts.app')

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
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ trans('cruds.home') }}</a></li>
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
                            <td> {{$item->products_count??''}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">{{ trans('cruds.action') }}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        @canany(['admin', 'view all orders'])
                                            <a class="dropdown-item" href="{{route('orders.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                                        @endcan

                                        @canany(['admin', 'update orders'])
                                        <a class="dropdown-item" href="{{route('orders.edit',$item->id)}}" >{{ trans('cruds.edit') }}</a>
                                        @endcan

                                        @canany(['admin', 'delete orders'])
                                        <form method="POST" action="{{ route('orders.destroy', $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" style="margin-left:6px;background: none; color: inherit; border: none; font: inherit; cursor: pointer; outline: inherit;" onclick="return confirm(&quot;Confirm delete?&quot;)">{{ trans('cruds.delete') }}</button>
                                        </form>
                                        @endcan


                                    </div>

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
