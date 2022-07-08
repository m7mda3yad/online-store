<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Entities\Admin\Product;
use App\Entities\Admin\SubFilter;

class ShowProduct extends Component{
    public $product;
    public $ids;
    public $filters=[];
    public $count;
    public $price;
    public $inputs = [];
    public $subids = [];
    public $filters_id = [];
    public $selectedFilter;


    public function submit($formData)
    {
        $arr=[];
        $count=0;
        dd($formData);
        while(isset($formData["subFilter[$count]"]))
        {
            $arr[$count]=$formData["subFilter[$count]"];
            $count++;
        }
        $this->addToCart($formData['product_id'],$arr);
    }
    public function subFilter($id)
    {
        $this->selectedFilter = SubFilter::findOrFail($id)->filter_id;
        $this->price =   \DB::table('product_sup_filters')->where('product_id',$this->product->id)->where('sub_filter_id',$id)->first()->price;
        $key = \DB::table('product_sup_filters')->where('product_id',$this->product->id)->where('sub_filter_id',$id)->pluck('key')->toArray();
        $this->filters_id = \DB::table('product_sup_filters')->whereIn('key',$key)->pluck('sub_filter_id')->toArray();
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
    public function sub($key,$id){
        $ids = session()->get('idd', []) ;
        $ids[$id]=$id;
        session()->put('idd',$ids);
        dd(session()->get('idd', []) );
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
    public function mount(){

    }
    public function render()
    {

        $this->ids = $this->product->sub_filters->pluck('filter_id')->unique()->toArray();
        foreach($this->ids as $key=>$id){
            $this->subids[$key]=0;
            $this->filters[$key]['name']= \DB::table('filters')->where('id',$id)->first()->name;
            $ub_ids= \DB::table('sub_filters')->where('filter_id',$id)->pluck('id')->unique()->toArray();
            $ub_id = \DB::table('product_sup_filters')->where('product_id',$this->product->id)->whereIn('sub_filter_id',$ub_ids)->where('amount','>','0')->pluck('sub_filter_id')->unique()->toArray();
            $this->filters[$key]['sub_filters'] = SubFilter::with('filter')->whereIn('id',$ub_id)->get();
        }
        return view('livewire.show-product');
    }



    public function addToCart($product_id,$subFilter)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($product_id)->only(['id','name','real_price','photo','description']);
        if($subFilter)
        $keys = \DB::table('product_sup_filters')->where('product_id',$product_id)->where('sub_filter_id',$subFilter)->pluck('key')->toArray();
        else
         $keys=[];
        $key = null;
        foreach($keys as $item){
            $count=\DB::table('product_sup_filters')->where('key',$item)->whereIn('sub_filter_id',$subFilter)->count();
            if( $count>=count($subFilter))
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
        return session()->get('cart', []);
    }


}
