@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.roles') }}</h1>

</div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.student') }}</li>
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
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{trans('cruds.edit')}} {{trans('cruds.student')}}</h3>
                    </div>
                    <form method="post" action="{{ route('roles.update',$role->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">

                            <div class="col-12">
                                <label >{{trans('cruds.name')}}</label>
                                <input type="string"  class="form-control" name="name"value="{{ $role->name }}">
                                @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <div class="row">

                                    @foreach ($permission as $item)
                                    <div class="col-3">
                                        <input class="btn btn-s btn-primary"type="checkbox" name="permission[]"value="{{ $item->id}}"
                                        {{ in_array($item->id,$rolePermissions)?'checked':'' }}>
                                        <label class="btn btn-s btn-primary">{{ $item->name}}</label>
                                    </div>
                                    @endforeach
                                    @error('permissions')<div class="text-danger">{{ $message }}</div> @enderror
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
