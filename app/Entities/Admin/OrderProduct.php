<?php


namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table="item_orders";
    protected $fillable =['order_id','product_id','amount','price','key'];

}
