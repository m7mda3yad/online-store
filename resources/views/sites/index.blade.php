@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
<script type="text/javascript" src="cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
    <div class="col-sm-6">
        </div>
      </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('cruds.edit')}} {{trans('cruds.notification')}}</h3>
                    </div>
                    <form method="post" action="{{ route('sites.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="isd" value="{{ $site->id??0 }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.name')}}</label>
                                <input class="form-control" name="name"  type="text" value="{{ $site->name??'' }}">
                            </div>
                                @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.email')}}</label>
                                <input class="form-control" name="email"  type="text" value="{{ $site->email??'' }}">
                            </div>
                                @error('email')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.phone1')}}</label>
                                <input class="form-control" name="phone1"  type="text" value="{{ $site->phone1??'' }}">
                            </div>
                                @error('phone1')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.phone2')}}</label>
                                <input class="form-control" name="phone2"  type="text" value="{{ $site->phone2??'' }}">
                            </div>
                                @error('phone2')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>



                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.address')}}</label>
                                <input class="form-control" name="address"  type="text" value="{{ $site->address??'' }}">
                            </div>
                                @error('address')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.facebook')}}</label>
                                <input class="form-control" name="facebook"  type="text" value="{{ $site->facebook??'' }}">
                            </div>
                                @error('facebook')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.instgram')}}</label>
                                <input class="form-control" name="instgram"  type="text" value="{{ $site->instgram??'' }}">
                            </div>
                                @error('instgram')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>


                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.youtube')}}</label>
                                <input class="form-control" name="youtube"  type="text" value="{{ $site->youtube??'' }}">
                            </div>
                                @error('youtube')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label>{{trans('cruds.logo')}}</label>
                                <input class="form-control" name="logo"  type="file" value="{{ $site->logo??'' }}">
                            </div>
                                @error('logo')<div class="text-danger">{{ $message }}</div> @enderror
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
