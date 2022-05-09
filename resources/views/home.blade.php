@extends('layouts.app')

@section('content')
   <div class="content-header">
       <div class="container-fluid">
       <div class="row mb-2">
           <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
           </div>
           <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item active">Dashboard </li>
           </ol>
           </div>
       </div>
       </div>
   </div>
<section class="content">
    <div class="container-fluid">
       <div class="row">
           <div class="col-lg-3 col-6">

           <div class="small-box bg-info">
               <div class="inner">
               <h3>{{$data['categories']}}</h3>
               <p>{{ trans('cruds.categories') }}</p>
               </div>
               <div class="icon">
               <i class="ion ion-bag"></i>
               </div>

               @canany(['admin','view all categories'])
                   <a  href="{{route('categories.index')}}"class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               @endcanany

            </div>
           </div>

           <div class="col-lg-3 col-6">

           <div class="small-box bg-success">
               <div class="inner">
                <h3>{{$data['users']}}</h3>
                <p>{{ trans('cruds.users') }}</p>
                </div>
               <div class="icon">
                 <i class="ion ion-stats-bars"></i>
               </div>
               @canany(['admin','view all users'])
                   <a  href="{{route('users.index')}}"class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               @endcanany
            </div>
           </div>
           <div class="col-lg-3 col-6">

               <div class="small-box bg-primary">
                  <div class="inner">
                        <h3>{{$data['products']}}</h3>
                        <p>{{ trans('cruds.products') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    @canany(['admin','view all products'])
                        <a  href="{{route('products.index')}}"class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    @endcanany
                </div>
           </div>

           <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$data['sub_categories']}}</h3>
                    <p>{{ trans('cruds.sub_categories') }}</p>
                </div>
                <div class="icon">
                <i class="ion ion-person-add"></i>
                </div>

                @canany(['admin','view all sub_categories'])
                    <a  href="{{route('sub_categories.index')}}"class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                @endcanany

            </div>
           </div>

       </div>
    </div>
</section>
@endsection
