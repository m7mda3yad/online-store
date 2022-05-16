<?php


function getFIlterId($id)
{
    if(isset(session()->get('cart', [])[$id])){
    if(session()->get('cart', [])[$id]['key'])
    return \DB::table('product_sup_filters')->
    where('key',session()->get('cart', [])[$id]['key'])->
    pluck('sub_filter_id')->toArray()??[];
    }
    return [];


}

function getFIlterByKey($key){
    $ids=\DB::table('product_sup_filters')->where('key',$key)->pluck('sub_filter_id')->toArray();
    $filters=\DB::table('sub_filters')->whereIn('id',$ids)->get();
        return $filters;
}
function getPriceByKey($key){

    return \DB::table('product_sup_filters')->where('key',$key)->first()->price??0;
}
function AllSubCategory(){

    return \DB::table('sub_categories')->where('active',1)->get();
}
function getamountByKey($key){

    return \DB::table('product_sup_filters')->where('key',$key)->first()->amount??0;
}
function getSubCategory(){

    return App\Entities\Admin\SubCategory::where('active',1)->has('products')->get();
}
