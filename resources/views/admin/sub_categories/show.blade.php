@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
            @canany(['admin', 'add products'])
               {{--  <a class="btn btn-block btn-primary" href="{{ route('products.add', ['id'=>$subCategory->id]) }}">Add</a>  --}}
                {{--  <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.add') }} {{trans('cruds.products') }}</button>  --}}
            @endcan
        </div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.levels') }}</li>
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
                                <td>{{$subCategory->id}}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('cruds.name') }}</th>
                                <td>{{$subCategory->name}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.category') }}</th>
                                <td>{{$subCategory->category->name}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.created_at') }}</th>
                                <td>{{$subCategory->created_at}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.photo') }}</th>
                                <td> <img src="{{$subCategory->photo??''}}"  sizes="150" width="150" height="150"></td>
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
                                <th>{{trans('cruds.real_price')}}</th>
                                <th>{{trans('cruds.suspend')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subCategory->products as $item)
                            <tr>
                                <td> {{$item->id??''}}</td>
                                <td>
                                    <a href="{{route('products.show',$item->id)}}" >{{ $item->name }}</a>
                                </td>
                                <td> {{$item->real_price}}</td>
                                <td class="center">
                                    @if($item->active==1)
                                    <svg style="color:blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/></svg>
                                      @else
                                      <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                                    @endif
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
                        <input type="hidden" name="sub_category_id"{{$subCategory->id}}>
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
                        <div class="col-12">
                            @foreach ($subCategory->filters as $item)
                                {{ $item->name }}
                                <div class="row">

                                    @foreach ( $item->sub_filters as $sub_filter)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>name</th>
                                                <th>amount</th>
                                                <th>price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $sub_filter->name }}</td>
                                                    <input value="{{$sub_filter->id}}" type="hidden" name="sub_filter_id[]">
                                                    <td><input type="number" name="amounts[]"></td>
                                                    <td><input type="number" name="prices[]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                            @endforeach
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
