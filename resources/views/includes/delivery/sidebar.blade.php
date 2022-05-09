<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home')}}" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->photo??''}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name??''}}</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append"><button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button></div>
            </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            @canany(['admin','view all orders'])
                <li class="nav-item menu{{in_array(Route::currentRouteName(),[
                    'orders.index','delivery.order.assign','delivery.order.delivered','delivery.order.cancelled'
                    ]) ? '-open':'' }}">
                    <a href="#" class="nav-link
                    {{in_array(Route::currentRouteName(),[
                        'orders.index','delivery.order.assign','delivery.order.delivered','delivery.order.cancelled'
                        ]) ? 'active':'' }}">
                <i class="nav-icon fa
            s fa-tachometer-alt"></i>
                    <p>
                        {{trans('cruds.orders')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('delivery.order.assign')}}" class="nav-link {{in_array(Route::currentRouteName(),['delivery.order.assign']) ? 'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{trans('cruds.order_assign')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('delivery.order.delivered')}}" class="nav-link {{in_array(Route::currentRouteName(),['delivery.order.delivered']) ? 'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{trans('cruds.order_delivered')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('delivery.order.cancelled')}}" class="nav-link {{in_array(Route::currentRouteName(),['delivery.order.cancelled']) ? 'active':'' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{trans('cruds.order_cancelled')}}</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan


            <li class="nav-item">
                <a href="{{route('delivery.profile')}}" class="nav-link {{in_array(Route::currentRouteName(),['delivery.profile']) ? 'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>{{trans('cruds.profile')}}</p>
                </a>
            </li>

        </ul>
        </nav>
    </div>
</aside>

