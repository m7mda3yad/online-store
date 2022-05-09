<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Entities\Admin\Product;
use App\Entities\Admin\Category;
use App\Entities\Admin\SubCategory;

class ShowProducts extends Component{

    public $count;
    public  $products;
    public $categories;
    public $sub_category;
    public $category_id;

    public function subCategory($id)
    {
        $this->sub_category=SubCategory::findOrFail($id);
        $this->category_id=$id;
       $this->products  = $this->sub_category->products;
    }
    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $this->count=count(session()->get('cart', []));

    }

    public function favorite($id)
    {
        $product = Product::findOrFail($id);
        \Auth::guard('customer')->user()->favorites()->syncWithoutDetaching($id);
    }
    public function unfavorite($id)
    {
        $product = Product::findOrFail($id);
        \Auth::guard('customer')->user()->favorites()->detach($id);
    }
    public function mount()
    {
        $this->categories= Category::all();
        $this->sub_category= SubCategory::first();
        $this->category_id = $this->sub_category->id;
        $this->products =$this->sub_category->products;
    }

    public function render()
    {
        return view('livewire.show-products');
    }
}
