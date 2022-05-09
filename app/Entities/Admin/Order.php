<?php
namespace App\Entities\Admin;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\User;
class Order extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = ['user_id','delivery_type','paid_type','date','delivery_id' ];


    public function products()
    {
        return $this->belongsToMany(Product::class,'item_orders')->withPivot(['price','amount','key']);
    }
    // type_delivery

    public function gettypeDeliveryAttribute()
    {
        if($this->delivery_id==null)     return 'New';
        if($this->delivery_type==0)      return "Not Delivered";
        if($this->delivery_type==1)      return  "Delivered";
        if($this->delivery_type==3)      return  "Cancelled";
    }
    public function getTotalAttribute()
        {
            $total=0;
            $products = \DB::table('item_orders')->where('order_id',$this->id)->get();
            foreach($products as $item)
            $total= $total + $item->amount	 * $item->price;
            return $total;

        }
    public function customer()
    {
        return $this->belongsTo(Customer::Class,'user_id');
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::Class,'delivery_id');
    }


}
