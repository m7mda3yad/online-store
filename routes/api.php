<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('get_filters', function (Request $request) {
    $ids = array_map('intval', explode(',', $request->id));

     return  App\Entities\Admin\SubFilter::with('filter:id,name')->whereIn('id',$ids)->select('id','name','filter_id')->get();
})->name('get_filters');

Route::middleware(['cors'])->group(function () {
});
