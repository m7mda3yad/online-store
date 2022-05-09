@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.role') }}</h1>
            <br>
        </div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.role') }}</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.id') }}</th>
                        <td>{{$role->id}}</td>
                    </tr>

                    <tr>
                        <th>{{ trans('cruds.name') }}</th>
                        <td>{{$role->name}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.created_at') }}</th>
                        <td>{{$role->created_at}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.permissions') }}</th>
                        <td class="row">

                                @foreach ($role->permissions as $item)
                                <div class="col-3">

                                    <input type="button"  class="btn btn-s" value="{{ $item->name }}">
                                </div>

                                @endforeach


                        </td>







                    </tr>
                </thead>
                    </table>

            </div>
        </div>
    </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
