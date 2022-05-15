<?php
use Illuminate\Support\Facades\Route;
    Auth::routes();
    Route::post('customer/login', 'Auth\LoginController@customerLogin')->name('customer.login');
    Route::get('customer/login', 'Auth\LoginController@FormCustomerLogin')->name('customer.login.form');

    Route::post('delivery/login', 'Auth\LoginController@deliveryLogin')->name('delivery.login');
    Route::get('delivery/login', 'Auth\LoginController@FormDeliveryLogin')->name('delivery.login.form');

    Route::resource('subscribes', 'Admin\SubscribesController');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::resource('contacts', 'Admin\ContactsController');

    Route::middleware(['check-customer'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/callback', 'HomeController@callback')->name('callback');
        Route::get('/error', 'HomeController@callback')->name('error');
        Route::get('/order', 'HomeController@orders')->name('order');
        Route::get('/order/{id}', 'HomeController@order_show')->name('order.show');
        Route::get('profile', 'HomeController@profile')->name('profile');
        Route::put('profile/update', 'HomeController@profile_update')->name('profile.update');
        Route::get('checkout', 'HomeController@checkout')->name('checkout');
        Route::get('favorite/product/{id}', 'Admin\ProductsController@favorite')->name('product.favorite');
        Route::get('show/favorite', 'Admin\ProductsController@showFavorite')->name('show.favorite');

});
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin', 'HomeController@index')->name('admin');
    });

Route::get('sql', function () {
  return  \Spatie\DbDumper\Databases\MySql::create()
    ->setDbName('store')
    ->setUserName('root')
    ->setPassword('')
    ->dumpToFile('store.sql');

});

    Route::get('cart', 'Admin\CartController@cart')->name('cart');
Route::get('/show-products/{id}', 'Admin\CartController@show_products')->name('show-products.show');
Route::get('/product/show/{id}', 'Admin\CartController@show_product')->name('product.show');
Route::get('/', 'Admin\CartController@index')->name('index');
Route::get('addToCart', 'Admin\CartController@addToCart')->name('addToCart');


Route::middleware(['auth'])->namespace('Delivery')->group(function () {
    Route::get('/delivery', 'DeliveryController@index');
    Route::get('delivery/profile', 'DeliveryController@profile')->name('delivery.profile');

    Route::get('delivery/order/assign', 'DeliveryController@assign')->name('delivery.order.assign');
    Route::get('delivery/order/delivered', 'DeliveryController@delivered')->name('delivery.order.delivered');
    Route::get('delivery/order/cancelled', 'DeliveryController@cancelled')->name('delivery.order.cancelled');


});
    Route::middleware(['auth'])->namespace('Admin')->group(function () {
    Route::resource('categories', 'CategoriesController');
    Route::get('categories/suspend', 'CategoriesController@index')->name('categories.suspend');

    Route::resource('countries', 'CountriesController');
    Route::get('countries/suspend', 'CategoriesController@index')->name('countries.suspend');
    Route::resource('deliveries', 'DeliveriesController');
    Route::get('deliveries/suspend', 'CategoriesController@index')->name('deliveries.suspend');

    Route::resource('customers', 'CustomersController');

    Route::resource('sites', 'SitesController');

    Route::resource('cities', 'CitiesController');
    Route::get('cities/suspend', 'CategoriesController@index')->name('cities.suspend');

    Route::resource('orders', 'OrdersController');
    Route::post('orders/assign/delivery', 'OrdersController@delivery')->name('orders.assign.delivery');

    Route::get('new/order', 'OrdersController@new')->name('order.new');
    Route::get('assign/orders', 'OrdersController@assign')->name('orders.assign');
    Route::get('delivered/orders', 'OrdersController@delivered')->name('orders.delivered');

    Route::get('delivered/order/{id}', 'OrdersController@deliveredOrder')->name('order.deliveredOrder');
    Route::get('cancelled/order/{id}', 'OrdersController@cancelledOrder')->name('order.cancelledOrder');

    Route::resource('filters', 'FiltersController');
    Route::get('filters/suspend', 'SubCategoriesController@index')->name('filters.suspend');

    Route::resource('sub_filters', 'SubFiltersController');
    Route::get('sub_filters/suspend', 'SubFiltersController@index')->name('sub_filters.suspend');

    Route::resource('sub_categories', 'SubCategoriesController');
    Route::get('sub_categories/suspend', 'SubCategoriesController@index')->name('sub_categories.suspend');
    Route::get('sub_categories/assign_filter/{id}', 'SubCategoriesController@assign_filter')->name('sub_categories.assign_filter');
    Route::post('sub_categories/assign_filter', 'SubCategoriesController@post_assign_filter')->name('post.sub_categories.assign_filter');

    Route::resource('products', 'ProductsController');
    Route::get('products/suspend', 'ProductsController@index')->name('products.suspend');
    Route::get('products/create/{id}', 'ProductsController@create')->name('products.add');
    Route::get('products/filter/{id}', 'ProductsController@filter')->name('products.filter');
    Route::post('products/filter/edit', 'ProductsController@editFilter')->name('products.filter.edit');

    Route::resource('users', 'ProductsController');

    Route::resource('roles', 'CategoriesController');



});



