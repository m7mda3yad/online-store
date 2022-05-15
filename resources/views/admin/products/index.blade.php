@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.products') }}</h1>
            <br>
            <div class="col-sm-4">
                @canany(['admin', 'add products'])
                    <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.add') }} {{trans('cruds.products') }}</button>
                @endcan
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
            <li class="breadcrumb-item active">{{ trans('cruds.products') }}</li>
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
                @include('admin.products.table')
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
                  <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.products') }}</h3>
                </div>
                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label >{{trans('cruds.name')}}</label>
                            <input type="string"  class="form-control" name="name" placeholder="{{trans('cruds.name')}}">
                            @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.sub_category')}}</label>
                            <select class="form-control select2" name="sub_category_id"style="width: 100%;">
                                @foreach ($sub_category as $item)
                                    <option value="{{$item->id}}">{{$item->name}} / {{$item->university->name??''}}</option>
                                @endforeach
                              </select>
                            @error('sub_category_id')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.price')}}</label>
                            <input type="number"  class="form-control" name="price" placeholder="{{trans('cruds.price')}}">
                            @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.real_price')}}</label>
                            <input type="number"  class="form-control" name="real_price" placeholder="{{trans('cruds.real_price')}}">
                            @error('real_price')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.amount')}}</label>
                            <input type="number"  class="form-control" name="amount" placeholder="{{trans('cruds.amount')}}">
                            @error('amount')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label >{{trans('cruds.description')}}</label>
                            <input type="description"  class="form-control" name="description" placeholder="{{trans('cruds.description')}}">
                            @error('description')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label for="photo">{{trans('cruds.photo')}}</label>
                            <div class="input-group">
                                <div class="">
                                    <input type="file" class="form-control" name="photo">
                                    <label class="" for="photo">{{trans('cruds.choose')}} {{trans('cruds.photo')}} </label>
                                </div>
                            </div>
                            @error('photo')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

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
