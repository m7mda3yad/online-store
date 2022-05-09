<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Entities\Admin\Product;

class ShowCart extends Component
{

    public $products;

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        $this->products =$this->products();
    }

    public function plus($id)
    {
        $cart = session()->get('cart');
        $product = Product::findOrFail($id);

        if($cart[$id]["key"]){
            if($cart[$id]["quantity"]< getamountByKey($cart[$id]["key"]))
            $cart[$id]["quantity"]++ ;
        }
        elseif($cart[$id]["quantity"]<$product->amount)
            $cart[$id]["quantity"]++ ;

        session()->put('cart', $cart);

    }

    public function minus($id)
    {
        $cart = session()->get('cart');
        if($cart[$id]["quantity"]-1>0)
        $cart[$id]["quantity"]-- ;

        session()->put('cart', $cart);

    }

    public function mount()
    {
        $this->products =$this->products();
    }
    public function products()
    {
        $ids=[];
        foreach((array) session('cart') as $id => $details)
        {
            $ids[]=$id;
        }
        return Product::find($ids);

    }


    public function render()
    {
        return view('livewire.show-cart');
    }
}
