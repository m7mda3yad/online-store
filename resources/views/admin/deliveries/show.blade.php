@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.delivery') }}</h1>
            <br>
            <br>
        </div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.delivery') }}</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.id') }}</th>
                        <td>{{$delivery->id}}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('cruds.name') }}</th>
                        <td>{{$delivery->name}}</td>
                    </tr>


                    <tr>
                        <th>{{ trans('cruds.email') }}</th>
                        <td>{{$delivery->email}}</td>
                    </tr>


                    <tr>
                        <th>{{ trans('cruds.phone') }}</th>
                        <td>{{$delivery->phone}}</td>
                    </tr>


                    <tr>
                        <th>{{ trans('cruds.university') }}</th>
                        <td>{{$delivery->university}}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('cruds.suspend') }}</th>
                        <td class="center">
                            @if($delivery->active==1)
                            <svg style="color:blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/></svg>
                              @else
                              <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                            @endif
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.created_at') }}</th>
                        <td>{{$delivery->created_at}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.photo') }}</th>
                        <td> <img src="{{$delivery->photo??''}}"  sizes="150" width="150" height="150"></td>
                    </tr>
                </thead>
                    </table>

                    <div class="col-sm-6">
                        <h1>{{ trans('cruds.orders') }}</h1>
                            <br>
                    </div>

                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{trans('cruds.id')}}</th>
                                    <th>{{trans('cruds.order')}}</th>
                                    <th>{{trans('cruds.count')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($delivery->orders as $item)
                                <tr>
                                    <td> {{$item->id??''}}</td>
                                    <td>
                                        @canany(['admin', 'view all orders'])
                                            <a href="{{route('orders.show',$item->id)}}" >Order</a>
                                        @endcanany

                                    </td>
                                    <td>{{ $item->products->count() }}</td>
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
  @endsection
