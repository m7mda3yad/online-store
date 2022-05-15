@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.cities') }}</h1>
            <br>
            <div class="col-sm-4">
                @canany(['admin', 'add cities'])
                    <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.add') }} {{trans('cruds.cities') }}</button>
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
            <li class="breadcrumb-item active">{{ trans('cruds.cities') }}</li>
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
                  <th>{{trans('cruds.name')}}</th>
                  <th>{{trans('cruds.countries')}}</th>
                  <th>{{trans('cruds.price')}}</th>
                  <th>{{trans('cruds.suspend')}}</th>
                  <th>{{ trans('cruds.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $item)
                        <tr>
                            <td> {{$item->id??''}}</td>
                            <td> {{$item->name??''}}</td>
                            <td> {{$item->country->name??''}}</td>
                            <td> {{$item->price??''}}</td>
                            <td class="center">
                            @if($item->active==1)
                            <svg style="color:blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/></svg>
                                @else
                                <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                            @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">{{ trans('cruds.action') }}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        @canany(['admin', 'view all cities'])
                                            <a class="dropdown-item" href="{{route('cities.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                                        @endcan
                                        @canany(['admin', 'update cities'])
                                            <a class="dropdown-item" href="{{route('cities.edit',$item->id)}}" >{{ trans('cruds.edit') }}</a>
                                        @endcan
                                        @canany(['admin', 'suspend cities'])
                                            <a class="dropdown-item" href="{{route('cities.suspend',$item->id)}}" >
                                                {{ $item->active==1?trans('cruds.suspend'):trans('cruds.unsuspend') }}</a>
                                        @endcan
                                        @canany(['admin', 'delete cities'])
                                            <form method="POST" action="{{ route('cities.destroy', $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" style="margin-left:6px;background: none; color: inherit; border: none; font: inherit; cursor: pointer; outline: inherit;" onclick="return confirm(&quot;Confirm delete?&quot;)">{{ trans('cruds.delete') }}</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>{{trans('cruds.id')}}</th>
                    <th>{{trans('cruds.name')}}</th>
                    <th>{{trans('cruds.countries')}}</th>
                    <th>{{trans('cruds.price')}}</th>
                    <th>{{trans('cruds.suspend')}}</th>
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


{{--  <div class="modal fade" id="modal-lg">
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
                    <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.cities') }}</h3>
                    </div>
                    <form action="{{route('cities.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{trans('cruds.name')}}</label>
                                <input type="text" required class="form-control" name="name" placeholder="{{trans('cruds.name')}}">
                                @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="price">{{trans('cruds.price')}}</label>
                                <input type="text" required class="form-control" name="price" placeholder="{{trans('cruds.price')}}">
                                @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>


                        <div class="col-6">
                            <label >{{trans('cruds.countries')}}</label>
                            <select class="form-control select2" name="country_id"style="width: 100%;">
                                @foreach ($countries as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                            @error('country_id')<div class="text-danger">{{ $message }}</div> @enderror
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
</div>  --}}


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
                    <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.cities') }}</h3>
                    </div>
                    <form action="{{route('cities.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="price">{{trans('cruds.area')}}</label>
                                <textarea name="area" class="form-control" cols="30" rows="10"></textarea>
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
