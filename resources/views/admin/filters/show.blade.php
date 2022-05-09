@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.filters') }}</li>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.id') }}</th>
                                <td>{{$filter->id}}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('cruds.name') }}</th>
                                <td>{{$filter->name}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.created_at') }}</th>
                                <td>{{$filter->created_at}}</td>
                            </tr>
                        </thead>
                    </table>




                <div class="col-sm-6">
                    <h1>{{ trans('cruds.sub_filters') }}</h1>
                        <br>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>{{trans('cruds.id')}}</th>
                                <th>{{trans('cruds.name')}}</th>
                                <th>{{trans('cruds.suspend')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filter->sub_filters as $item)
                            <tr>
                                <td> {{$item->id??''}}</td>
                                <td>
                                <a href="{{route('cities.show',$item->id)}}" >{{ $item->name }}</a>
                                </td>
                                <td class="center">
                                    @if($item->active==1)
                                    <svg style="color:blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock-fill" viewBox="0 0 16 16"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/></svg>
                                      @else
                                      <svg style="color:red" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/></svg>
                                    @endif
                                    </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
  @endsection
