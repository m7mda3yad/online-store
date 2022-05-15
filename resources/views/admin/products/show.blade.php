@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $product->name??'' }}</h1>
          <br>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                    <tr>
                                        <th>{{ trans('cruds.id') }}</th>
                                        <td>{{$product->id}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.name') }}</th>
                                        <td>{{$product->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.price') }}</th>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.amount') }}</th>
                                        <td>{{$product->amount}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.sub_category') }}</th>
                                        <td>{{$product->sub_category->name??''}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.real_price') }}</th>
                                        <td>{{$product->real_price}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.suspend') }}</th>
                                        <td class="center">
                                            @if($product->active==1)
                                            <svg style="color:blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/></svg>
                                            @else
                                            <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                                            @endif
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.created_at') }}</th>
                                        <td>{{$product->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.description') }}</th>
                                        <td>{{$product->description}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('cruds.filter') }}</th>
                                        <td>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Sub Filter</th>
                                                        <th>amount</th>
                                                        <th>price</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            @foreach ($product->key as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>
                                                    <div class="row">
                                                        @foreach ($product->key($item) as $filter)
                                                        <div class="col-3">
                                                            <label class="btn btn-sm btn-outline-black">{{ $filter->name}}</label>
                                                        </div>
                                                        @endforeach
                                                    </div>

                                                    </td>
                                                    <td> {{$filter->pivot->amount}} </td>
                                                    <td>  {{$filter->pivot->price}} </td>
                                                    <td><button onclick="editFilter('{{ $filter->pivot->key}}',{{$filter->pivot->amount}},{{$filter->pivot->price }})" type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.edit') }}</button></td>
                                                </tr>
                                            @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>{{ trans('cruds.photo') }}</th>
                                        <td> <img src="{{$product->photo??''}}"  sizes="150" width="150" height="150"></td>
                                    </tr>
                            </thead>
                        </table>
                    </div>

                    <form action="{{ route('products.filter',$product->id) }}">
                        <div class="form-group row">
                            @foreach ($product->sub_category->filters as $filters)
                                <div class="col-3">
                                    <label >{{ $filters->name }}</label>
                                    <select class="form-control"  name="sub_filter[]">
                                        <option value="">filter</option>
                                        @foreach ($filters->sub_filters as $subfilter)
                                            <option value="{{$subfilter->id}}">{{$subfilter->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endforeach
                             <div class="form-group">
                                <label for="price">{{trans('cruds.price')}}</label>
                                <input type="text" class="form-control" name="price">
                                @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                             <div class="form-group">
                                <label for="amount">{{trans('cruds.amount')}}</label>
                                <input type="text" class="form-control" name="amount">
                                @error('amount')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('cruds.submit')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  @endsection























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
                <form action="{{route('products.filter.edit')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <input type="hidden" name="key" id="key">

                        <div class="col-6">
                            <label >{{trans('cruds.price')}}</label>
                            <input type="number"  id="price" class="form-control" name="price" placeholder="{{trans('cruds.price')}}">
                            @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.amount')}}</label>
                            <input type="number" id="amount"  class="form-control" name="amount" placeholder="{{trans('cruds.amount')}}">
                            @error('amount')<div class="text-danger">{{ $message }}</div> @enderror
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
<script>
function editFilter(key,amount,price)
{
    document.getElementById('key').value=key;
    document.getElementById('amount').value=amount;
    document.getElementById('price').value=price;
}

</script>
