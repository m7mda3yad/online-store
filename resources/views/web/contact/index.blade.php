@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.contact_us') }}</h1>
            <br>
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
            <li class="breadcrumb-item active">{{ trans('cruds.contact_us') }}</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{trans('cruds.id')}}</th>
                  <th>{{trans('cruds.message')}}</th>
                  <th>{{trans('cruds.user')}}</th>
                  <th>{{ trans('cruds.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($contact as $item)
                    <tr>
                        <td> {{$item->id??''}}</td>
                        <td style="max-width: 40px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap"> {{$item->description??''}}</td>
                        <td> {{$item->user->email??''}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">{{ trans('cruds.action') }}</button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    @canany(['admin', 'view all contact-us'])
                                        <a class="dropdown-item" href="{{route('contact-us.show',$item->id)}}" >{{ trans('cruds.view') }}</a>
                                    @endcan
                                    @canany(['admin', 'delete contact-us'])
                                    <form method="POST" action="{{ route('contact-us.destroy', $item->id) }}"
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
                    <th>{{trans('cruds.message')}}</th>
                    <th>{{trans('cruds.user')}}</th>
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
