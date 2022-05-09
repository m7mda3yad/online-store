@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.roles') }}</h1>
            <br>
            <div class="col-sm-4">
                @canany(['admin', 'add role'])
                <a  class="btn btn-block btn-primary "href={{route('roles.create')}}> {{trans('cruds.roles') }}</a>
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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.roles') }}</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{trans('cruds.id')}}</th>
                  <th>{{trans('cruds.name')}}</th>
                  <th>{{ trans('cruds.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $item)
                    <tr>
                        <td> {{$item->id??''}}</td>
                        <td> {{$item->name??''}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">{{ trans('cruds.action') }}</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    @canany(['admin', 'view all role'])
                                        <a class="dropdown-item" href="{{route('roles.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                                    @endcan
                                    @if($item->name !='admin')
                                        @canany(['admin', 'update role'])
                                        <a class="dropdown-item" href="{{route('roles.edit',$item->id)}}" >{{ trans('cruds.edit') }}</a>
                                        @endcan

                                        @canany(['admin', 'delete role'])
                                        <form method="POST" action="{{ route('roles.destroy', $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" style="margin-left:6px;background: none; color: inherit; border: none; font: inherit; cursor: pointer; outline: inherit;" onclick="return confirm(&quot;Confirm delete?&quot;)">{{ trans('cruds.delete') }}</button>
                                        </form>
                                        @endcan
                                    @endif


                                </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
                <tfoot>
                <tr>
                    <th>{{trans('cruds.id')}}</th>
                    <th>{{trans('cruds.name')}}</th>
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
  @endsection
