<?php

namespace App\Entities\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable=[
        'InvoiceId','InvoiceURL','InvoiceStatus','IsSuccess','InvoiceValue','price','order_id','customer_id','TransactionDate'
    ];

}

