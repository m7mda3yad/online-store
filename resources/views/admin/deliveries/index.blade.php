@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.deliveries') }}</h1>
            <br>
            <div class="col-sm-4">
                @canany(['admin', 'add deliveries'])
                    <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.add') }} {{trans('cruds.deliveries') }}</button>
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
            <li class="breadcrumb-item active">{{ trans('cruds.deliveries') }}</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{trans('cruds.id')}}</th>
                  <th>{{trans('cruds.name')}}</th>
                  <th>{{trans('cruds.phone')}}</th>
                  <th>{{trans('cruds.email')}}</th>
                  <th>{{ trans('cruds.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $item)
                    <tr>
                        <td> {{$item->id??''}}</td>
                        <td> {{$item->name??''}}</td>
                        <td> {{$item->phone??''}}</td>
                        <td> {{$item->email??''}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">{{ trans('cruds.action') }}</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    @canany(['admin', 'view all deliveries'])
                                        <a class="dropdown-item" href="{{route('deliveries.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                                    @endcan

                                    @canany(['admin', 'update deliveries'])
                                    <a class="dropdown-item" href="{{route('deliveries.edit',$item->id)}}" >{{ trans('cruds.edit') }}</a>
                                    @endcan

                                    @canany(['admin', 'delete deliveries'])
                                    <form method="POST" action="{{ route('deliveries.destroy', $item->id) }}"
                                          accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" style="margin-left:6px;background: none; color: inherit; border: none; font: inherit; cursor: pointer; outline: inherit;" onclick="return confirm(&quot;Confirm delete?&quot;)">{{ trans('cruds.delete') }}</button>
                                    </form>
                                    @endcan


                                </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
                <tfoot>
                <tr>
                    <th>{{trans('cruds.id')}}</th>
                    <th>{{trans('cruds.name')}}</th>
                    <th>{{trans('cruds.phone')}}</th>
                    <th>{{trans('cruds.email')}}</th>
                    <th>{{ trans('cruds.action') }}</th>
                  </tr>
                </tfoot>
              </table>
              <div class="pagination-wrapper justify-content-center text-main">
                {{ $deliveries->links() }}
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
                  <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.deliveries') }}</h3>
                </div>
                <form action="{{route('deliveries.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">

                        <div class="col-6">
                            <label >{{trans('cruds.name')}}</label>
                            <input type="string"  class="form-control" name="name" placeholder="{{trans('cruds.name')}}">
                            @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.phone')}}</label>
                            <input type="text"  class="form-control" name="phone" placeholder="{{trans('cruds.phone')}}">
                            @error('phone')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.email')}}</label>
                            <input type="email"  class="form-control" name="email" placeholder="{{trans('cruds.email')}}">
                            @error('email')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-6">
                            <label >{{trans('cruds.password')}}</label>
                            <input type="password"  class="form-control" name="password" placeholder="{{trans('cruds.password')}}">
                            @error('password')<div class="text-danger">{{ $message }}</div> @enderror
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
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->




  @endsection
