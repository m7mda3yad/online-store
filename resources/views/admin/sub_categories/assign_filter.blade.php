@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.sub_categories') }}</h1>
        </div>
         <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.sub_categories') }}</li>
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
                    <h3 class="card-title">{{trans('cruds.edit')}} {{trans('cruds.sub_categories')}}</h3>
                    </div>
                    <form method="post" action="{{ route('post.sub_categories.assign_filter') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="sub_category_id" value="{{$subCategory->id}}">
                            <div class="form-group">
                                <label for="name">{{trans('cruds.filter')}}</label>
                                <select class="form-control select2" multiple name="filter_id[]"style="width: 100%;">
                                    @foreach ($filters as $item)
                                        <option value="{{$item->id}}"{{in_array($item->id,$ids)?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('filter_id')<div class="text-danger">{{ $message }}</div> @enderror
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
