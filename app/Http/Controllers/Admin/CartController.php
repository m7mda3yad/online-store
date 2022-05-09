<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entities\Admin\Product;
use App\Entities\Admin\SubCategory;
use App\Http\Controllers\Controller;
class CartController extends Controller
{
    public function index()
    {
        $SubCategory= SubCategory::has('products')->with('products')->get();
        return view('customer.index',compact('SubCategory'));
    }
    public function show_products($id)
    {
        $SubCategory= SubCategory::findOrFail($id);
        $SubCategoryId=$id;
        return view('customer.show_products',compact('SubCategoryId'));
    }

    public function show_product($id)
    {
        $product= Product::findOrFail($id);
        return view('customer.show_product',compact('product'));
    }

    public function cart()
    {
    return view('customer.cart');
    }

    public function addToCart(Request $request)
    {
        $id=21;
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($request->product_id)->only(['id','name','real_price','photo','description']);
        if($request->subFilter)
        $keys = \DB::table('product_sup_filters')->where('product_id',$request->product_id)->where('sub_filter_id',$request->subFilter)->pluck('key')->toArray();
        else
         $keys=[];
        $key = null;
        foreach($keys as $item){
            $count=\DB::table('product_sup_filters')->where('key',$item)->whereIn('sub_filter_id',$request->subFilter)->count();
            if( $count>=count($request->subFilter))
                $key= $item;

        }
            if($key!=null)
                $product['real_price']=\DB::table('product_sup_filters')->where('key',$item)->first()->price;
            if(isset($cart[$product['id']])) {
                $cart[$id]['quantity']++;
            } else {
            $cart[$product['id']] = [
                "product" => $product,
                "quantity" => 1,
                "key" =>$key,
            ];
        }
        session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }


    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
