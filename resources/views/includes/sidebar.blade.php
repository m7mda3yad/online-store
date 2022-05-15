<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin')}}" class="brand-link">
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

            @canany(['admin','view content section'])
                <li class="nav-item menu{{in_array(Route::currentRouteName(),[
                    'categories.index','categories.edit','categories.show',
                    'sub_categories.index','sub_categories.edit','sub_categories.show',
                    'products.index','products.edit','products.show',
                    'filters.index','filters.edit','filters.show',
                    'sub_filters.index','sub_filters.edit','sub_filters.show'
                ]) ? '-open':'' }}">
                    <a href="#" class="nav-link
                    {{in_array(Route::currentRouteName(),[
                        'categories.index','categories.edit','categories.show',
                        'sub_categories.index','sub_categories.edit','sub_categories.show',
                        'products.index','products.edit','products.show','subjects.index','subjects.edit','subjects.show',
                        'filters.index','filters.edit','filters.show',
                        'sub_filters.index','sub_filters.edit','sub_filters.show',
                          ]) ? 'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans('cruds.content')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @canany(['admin','view all categories'])
                        <li class="nav-item">
                            <a href="{{route('categories.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['categories.index','categories.edit','categories.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.categories')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view all sub_categories'])
                        <li class="nav-item">
                            <a href="{{route('sub_categories.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['sub_categories.index','sub_categories.edit','sub_categories.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.sub_categories')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view all products'])
                        <li class="nav-item">
                            <a href="{{route('products.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['products.index','products.edit','products.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.products')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view all filters'])
                        <li class="nav-item">
                            <a href="{{route('filters.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['filters.index','filters.edit','filters.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.filters')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view all sub_filters'])
                        <li class="nav-item">
                            <a href="{{route('sub_filters.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['sub_filters.index','sub_filters.edit','sub_filters.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.sub_filters')}}</p>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
            @endcan


            @canany(['admin','view delivery section'])
                <li class="nav-item menu{{in_array(Route::currentRouteName(),[
                    'countries.index','countries.edit','countries.show',
                    'cities.index','cities.edit','cities.show']) ? '-open':'' }}">
                    <a href="#" class="nav-link
                    {{in_array(Route::currentRouteName(),[
                        'countries.index','countries.edit','countries.show',
                        'cities.index','cities.edit','cities.show'
                        ]) ? 'active':'' }}">
                <i class="nav-icon fa
                s fa-tachometer-alt"></i>
                        <p>
                            {{trans('cruds.delivery')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @canany(['admin','view all deliveries'])
                        <li class="nav-item">
                            <a href="{{route('deliveries.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['deliveries.index','deliveries.edit','deliveries.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.deliveries')}}</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin','view all countries'])
                        <li class="nav-item">
                            <a href="{{route('countries.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['countries.index','countries.edit','countries.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.countries')}}</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin','view all cities'])
                        <li class="nav-item">
                            <a href="{{route('cities.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['cities.index','cities.edit','cities.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.cities')}}</p>
                            </a>
                        </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @canany(['admin','view all orders'])
                <li class="nav-item menu{{in_array(Route::currentRouteName(),[
                    'orders.index','orders.edit','orders.show'
                    ]) ? '-open':'' }}">
                    <a href="#" class="nav-link
                    {{in_array(Route::currentRouteName(),[
                        'orders.index','orders.edit','orders.show'
                        ]) ? 'active':'' }}">
                <i class="nav-icon fa
                s fa-tachometer-alt"></i>
                        <p>
                            {{trans('cruds.orders')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        @canany(['admin','view all orders'])
                        <li class="nav-item">
                            <a href="{{route('orders.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['orders.index','orders.edit','orders.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.orders')}}</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin','view all orders'])
                        <li class="nav-item">
                            <a href="{{route('order.new')}}" class="nav-link {{in_array(Route::currentRouteName(),['orders.new']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.new_orders')}}</p>
                            </a>
                        </li>
                        @endcan


                        @canany(['admin','view all orders'])
                        <li class="nav-item">
                            <a href="{{route('orders.assign')}}" class="nav-link {{in_array(Route::currentRouteName(),['orders.assign']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.assign_orders')}}</p>
                            </a>
                        </li>
                        @endcan


                        @canany(['admin','view all orders'])
                        <li class="nav-item">
                            <a href="{{route('orders.delivered')}}" class="nav-link {{in_array(Route::currentRouteName(),['orders.delivered']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.delivered_orders')}}</p>
                            </a>
                        </li>
                        @endcan



                    </ul>
                </li>
            @endcan


            @canany(['admin','view website section'])
                <li class="nav-item menu{{in_array(Route::currentRouteName(),['roles.index','roles.edit','roles.show','users.index','users.edit','users.show','notifications.index','notifications.edit','notifications.show','contact-us.index','contact-us.show','about-us.index','about-us.edit','about-us.show','all-payment']) ? '-open':'' }}">
                    <a href="#" class="nav-link
                    {{in_array(Route::currentRouteName(),['roles.index','roles.edit','roles.show','users.index','users.edit','users.show','notifications.index','notifications.edit','notifications.show','contact-us.index','contact-us.show','about-us.index','about-us.edit','about-us.show','all-payment']) ? 'active':'' }}">
                <i class="nav-icon fa
                s fa-tachometer-alt"></i>
                        <p>
                            {{trans('cruds.website')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @canany(['admin','view all roles'])
                        <li class="nav-item">
                            <a href="{{route('roles.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['roles.index','roles.edit','roles.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.roles')}}</p>
                            </a>
                        </li>
                        @endcan

                        @canany(['admin','view all user'])
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['users.index','users.edit','users.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.users')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view all customers'])
                        <li class="nav-item">
                            <a href="{{route('customers.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['customers.index','customers.edit','customers.show']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.customers')}}</p>
                            </a>
                        </li>
                        @endcan
                        @canany(['admin','view site data'])
                        <li class="nav-item">
                            <a href="{{route('sites.index')}}" class="nav-link {{in_array(Route::currentRouteName(),['sites.index']) ? 'active':'' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{trans('cruds.site')}}</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan

        </ul>
        </nav>
    </div>
</aside>
