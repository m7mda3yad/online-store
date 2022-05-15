@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.products') }}</h1>
          <div class="col-sm-12">
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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('cruds.edit')}} {{trans('cruds.products')}}</h3>
                    </div>
                    <form method="post"class="form-horizontal" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.name') }}</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{{$product->name }}" name="name">
                                </div>
                                @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.price') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" value="{{$product->price}}" name="price">
                                </div>
                                @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.real_price') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" value="{{$product->real_price}}" name="real_price">
                                </div>
                                @error('real_price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.amount') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" value="{{$product->amount}}" name="amount">
                                </div>
                                @error('amount')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.sub_category') }}</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="sub_category_id">
                                    @foreach ($sub_category as $item)
                                        <option value="{{ $item->id }}"{{ $product->sub_category_id==$item->id?'selected':'' }}>{{ $item->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                @error('active')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.description') }}</label>
                                <div class="col-sm-8">
                                    <textarea  name="description"class="form-control">{{$product->description}} </textarea>
                                </div>
                                @error('description')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">{{ trans('cruds.photo') }}</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    @error('photo')<div class="text-danger">{{ $message }}</div> @enderror
                                <div class="col-6">
                                    <img src="{{$product->photo??''}}"  sizes="150" width="150" height="150">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('cruds.submit')}}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
