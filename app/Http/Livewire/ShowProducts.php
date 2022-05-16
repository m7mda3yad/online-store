<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Entities\Admin\Product;
use App\Entities\Admin\Category;
use App\Entities\Admin\SubCategory;

class ShowProducts extends Component{

    public $count;
    public  $products;
    public $sub_category;
    public $filters=[];
    public $ids=[];
    public $filterId=null;
    public $SubCategoryId;
    public $myProduct ;
    public $min;
    public $max ;
    public $my_price;
    public $max_price;

    public function updatedMyPrice(){
        // dd(\DB::table('products')->whereBetween('real_price', [0, $this->my_price])->get());
        if($this->my_price!=0)
        $this->products =$this->sub_category->products->where('real_price', '<=' , $this->my_price);
    }
    public function updatedMaxPrice(){
        // dd(\DB::table('products')->whereBetween('real_price', [0, $this->my_price])->get());
        if($this->my_price!=0)
        $this->products =$this->sub_category->products->whereBetween('real_price', [ $this->my_price,$this->max_price ]);
    }


    public function updatedFilterId()
    {
        if($this->filterId==null){
            $this->products  = $this->sub_category->products;
        }
        else{
            $ids = \DB::table('product_sup_filters')->where('sub_filter_id',$this->filterId)->pluck('product_id')->toArray();
            $this->products  =Product::find($ids);
        }
    }
    public function filte($id)
    {
        $this->filters[]+=$id;
            $ids = \DB::table('product_sup_filters')->whereIn('sub_filter_id',$this->filters)->pluck('product_id')->toArray();
            $this->products  = Product::WhereIn('id',$ids)->get();
        }
    public function subCategory($id)
    {
        $this->sub_category=SubCategory::findOrFail($id);
        $this->products  = $this->sub_category->products;
    }
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->real_price,
                "amount" => $product->amount,
                "photo" => $product->photo
            ];
        }
        session()->put('cart', $cart);
        $this->count=count(session()->get('cart', []));
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


    public function chooseProduct($id)
    {
        $this->myProduct= Product::findOrFail($id);
        $this->emit('show');
    }

    public function mount(){
        $this->filters=[];
        $this->sub_category= SubCategory::findOrFail($this->SubCategoryId);
        $this->min = \DB::table('products')->where('sub_category_id',$this->SubCategoryId)->min('real_price');
        $this->max = \DB::table('products')->where('sub_category_id',$this->SubCategoryId)->max('real_price');
        $this->my_price =$this->min ;
        $this->max_price = $this->max ;
        $ids=$this->sub_category->products->pluck('id')->toArray();
        $this->ids=\DB::table('product_sup_filters')->whereIn('product_id',$ids)->pluck('sub_filter_id')->toArray();

        $this->count=count(session()->get('cart', []));
        $this->products =$this->sub_category->products;
    }

    public function render()
    {
        return view('livewire.show-products');
    }
}
