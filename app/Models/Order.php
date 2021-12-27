<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    // protected $fillable = [
    //     'order_id',
    //     'product_id',
    //     'size_id',
    //     'color_id',
    //     'attributes,
    //     'image',
    //     'mrp_price',
    //     'sale_price',
    //     'discount',
    //     'discount_type',
    //     'status'
    // ];
}
