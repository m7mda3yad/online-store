@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.delivery') }}</h1>
        </div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.delivery') }}</li>
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{trans('cruds.edit')}} {{trans('cruds.delivery')}}</h3>
                        </div>
                        <form method="post" class="form-horizontal"    action="{{ route('deliveries.update',$delivery->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" >{{trans('cruds.name')}}</label>
                                    <div class="col-sm-8">
                                        <input type="string"  class="form-control" name="name"value="{{$delivery->name??''}}" placeholder="{{trans('cruds.name')}}">
                                    </div>
                                    @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" >{{trans('cruds.phone')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text"  class="form-control" name="phone"value="{{$delivery->phone??''}}" placeholder="{{trans('cruds.phone')}}">
                                    </div>
                                    @error('phone')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" >{{trans('cruds.email')}}</label>
                                    <div class="col-sm-8">
                                        <input type="email"  class="form-control" name="email"value="{{$delivery->email??''}}" placeholder="{{trans('cruds.email')}}">
                                    </div>
                                    @error('email')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" >{{trans('cruds.password')}}</label>
                                    <div class="col-sm-8">
                                        <input type="password"  class="form-control" name="password" placeholder="{{trans('cruds.password')}}">
                                    </div>
                                    @error('password')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">{{ trans('cruds.photo') }}</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    @error('photo')<div class="text-danger">{{ $message }}</div> @enderror
                                    <div class="col-6">
                                        <img src="{{$delivery->photo??''}}"  sizes="150" width="150" height="150">
                                    </div>
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
