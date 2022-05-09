@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ trans('cruds.contact_us') }}</h1>
            <br>
        </div>
    <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.contact_us') }}</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.id') }}</th>
                                <td>{{$contact->id}}</td>
                            </tr>

                            <tr>
                                <th>{{ trans('cruds.message') }}</th>
                                <td>{{$contact->description}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.student') }}</th>
                                <td>{{$contact->user->email??''}}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.created_at') }}</th>
                                <td>{{$contact->created_at}}</td>
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
